<?php

namespace App\Http\Controllers\Student;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Discussion;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));
    }
}
