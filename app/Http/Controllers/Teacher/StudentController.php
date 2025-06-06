<?php

// app/Http/Controllers/Teacher/StudentController.php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();
        
        $enrollments = Enrollment::with(['user' => function($query) {
                $query->where('role', 'student')->select('id', 'name', 'email');
            }])
            ->whereHas('course', function($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->whereHas('user')
            ->get()
            ->groupBy('user_id'); // Group by user_id au lieu de student_id

        return view('teacher.students.index', ['students' => $enrollments]);
    }
}