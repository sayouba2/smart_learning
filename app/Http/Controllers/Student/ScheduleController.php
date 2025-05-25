<?php

namespace App\Http\Controllers\Student;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Discussion;

class ScheduleController extends Controller
{
    public function index()
    {
        // Exemple simplifié : on suppose que le planning vient des cours ou assignments
        $schedule = Auth::user()->courses()->with('assignments')->get();
        return view('student.schedule', compact('schedule'));
    }
}