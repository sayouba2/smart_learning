<?php

namespace App\Http\Controllers\Student;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Discussion;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::whereHas('enrollments', function ($q) {
            $q->where('user_id', Auth::id());
        })->get();
        return view('student.quizzes', compact('quizzes'));
    }
}