<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Enrollment;

class AnalyticsController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();

        $courses = Course::where('teacher_id', $teacherId)->get();
        $totalCourses = $courses->count();
        $totalStudents = Enrollment::whereIn('course_id', $courses->pluck('id'))->count();

        return view('teacher.analytics.index', compact('totalCourses', 'totalStudents'));
    }
}
