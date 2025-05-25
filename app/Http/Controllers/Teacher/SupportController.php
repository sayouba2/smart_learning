<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function index()
    {
        return view('teacher.support.index');
    }
}
