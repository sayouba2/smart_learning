<?php

namespace App\Http\Controllers\Student;
use App\Models\Course;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->enrolledCourses()
                    ->with('teacher')
                    ->withPivot('completed_at')
                    ->latest('enrollments.created_at')
                    ->paginate(10);

        return view('student.courses.index', compact('courses'));
    }

public function myCourses()
{
    // Même contenu que la méthode index()
    $courses = Auth::user()->enrolledCourses()
                ->with(['teacher', 'category'])
                ->withPivot('completed_at')
                ->paginate(10);

    return view('student.courses.index', compact('courses'));
}
// app/Http/Controllers/Student/CourseController.php

public function show(Course $course)
{
    // Utilisez la relation enrollments() ou enrolledCourses() au lieu de course()
    $isEnrolled = Auth::user()->enrolledCourses()
                    ->where('course_id', $course->id)
                    ->exists();

    if (!$isEnrolled) {
        abort(403, 'Vous n\'êtes pas inscrit à ce cours.');
    }

    // Charger les relations nécessaires
    $course->load(['lessons', 'teacher', 'category', 'resources']);

    // Calculer la progression
    $completedLessons = Auth::user()->completedLessons()
                        ->where('course_id', $course->id)
                        ->count();
    $enrollmentCount = $course->enrollments()->count();
    return view('student.courses.show', [
        'course' => $course,
        'progress' => $this->calculateProgress($course, $completedLessons),
        'enrollment' => $enrollmentCount
    ]);
}

protected function calculateProgress(Course $course, $completedLessons)
{
    return $course->lessons->count() > 0 
           ? round(($completedLessons / $course->lessons->count()) * 100)
           : 0;
}

public function complete(Course $course)
{
    $enrollment = $course->enrollments()
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

    // Marquer toutes les leçons comme complétées
    $course->lessons->each(function($lesson) use ($enrollment) {
        $enrollment->completedLessons()->syncWithoutDetaching([$lesson->id]);
    });

    // Marquer le cours comme terminé
    $enrollment->update([
        'completed_at' => now(),
        'progress' => 100
    ]);

    return response()->json([
        'success' => true,
        'completed_at' => now()->format('d/m/Y')
    ]);
}
}
