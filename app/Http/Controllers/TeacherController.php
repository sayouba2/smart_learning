<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function show()
    {
        return view('teacher.dashboard');
    }
}
