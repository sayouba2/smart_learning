<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->get();
        $enrolledCourseIds = Auth::check()
            ? Auth::user()->enrollments()->pluck('course_id')->toArray()
            : [];

        return view('courses.index', compact('courses', 'enrolledCourseIds'));
    }
}

