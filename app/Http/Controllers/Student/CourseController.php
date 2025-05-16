<?php

namespace App\Http\Controllers\Student;
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
}
