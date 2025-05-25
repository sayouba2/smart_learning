<?php

namespace App\Http\Controllers\Student;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Discussion;

class ForumController extends Controller
{
    public function index()
    {
        $discussions = Discussion::where('user_id', Auth::id())->orWhere('visibility', 'public')->get();
        return view('student.forum', compact('discussions'));
    }
}