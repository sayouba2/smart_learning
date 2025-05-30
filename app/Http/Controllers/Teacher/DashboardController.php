<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistiques globales
        $courses = Course::withCount('students')
            ->where('teacher_id', $user->id)
            ->get();

        $stats = [
            'total_courses' => $courses->count(),
            'total_students' => $courses->sum('students_count'),
            'free_courses' => $courses->where('is_free', true)->count(),
        ];

        // Liste des 12 mois
        $months = collect(range(1, 12))->map(function ($month) {
            return \Carbon\Carbon::create(null, $month, 1)->translatedFormat('F');
        });

        // Inscriptions par mois
        $enrollments = DB::table('enrollments')
            ->join('courses', 'courses.id', '=', 'enrollments.course_id')
            ->where('courses.teacher_id', $user->id)
            ->whereYear('enrollments.created_at', now()->year)
            ->selectRaw('MONTH(enrollments.created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        $studentCounts = collect(range(1, 12))->map(function ($month) use ($enrollments) {
            return $enrollments[$month] ?? 0;
        });

        // Cours créés par mois
        $createdCourses = Course::where('teacher_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        $courseCounts = collect(range(1, 12))->map(function ($month) use ($createdCourses) {
            return $createdCourses[$month] ?? 0;
        });

        // Devoirs en attente (date limite future)
        $pending_assignments = Assignment::where('teacher_id', $user->id)
            ->where('due_date', '>', Carbon::now())
            ->count();

        return view('teacher.dashboard', compact(
            'courses', 'stats', 'months', 'studentCounts', 'courseCounts', 'pending_assignments'
        ));
    }
}
