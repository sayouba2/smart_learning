<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();
        $students = Enrollment::with('student')
            ->whereHas('course', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->get()
            ->groupBy('student_id');

        return view('teacher.students.index', compact('students'));
    }
}
