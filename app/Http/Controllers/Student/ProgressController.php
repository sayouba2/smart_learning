<?php

namespace App\Http\Controllers\Student;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Discussion;

class ProgressController extends Controller
{
    public function index()
    {
        // Exemple de progression : cours terminés vs total des cours
        $user = Auth::user();
        $totalCourses = $user->courses()->count();
        $completedCourses = $user->courses()->wherePivot('completed', true)->count();
        return view('student.progress', compact('totalCourses', 'completedCourses'));
    }
}