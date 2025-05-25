<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('teacher.settings.index');
    }
}
