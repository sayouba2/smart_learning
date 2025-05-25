<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('teacher_id', Auth::id())->with('course')->get();
        return view('teacher.quizzes.index', compact('quizzes'));
    }
}
