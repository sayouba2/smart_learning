<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // app/Http/Controllers/Teacher/DashboardController.php
public function index()
{
    $courses = Auth::user()->courses()
                  ->withCount('students')
                  ->with('category')
                  ->latest()
                  ->get();

    $stats = [
        'total_courses' => $courses->count(),
        'total_students' => $courses->sum('students_count'),
        'free_courses' => $courses->where('price', 0)->count(),
    ];

    return view('teacher.dashboard', compact('courses', 'stats'));
}
}
