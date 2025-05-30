<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // Récupère les IDs des cours auxquels l'étudiant est inscrit
    $courseIds = $user->enrolledCourses()->pluck('courses.id');

    // Récupère les devoirs liés à ces cours
    $assignments = Assignment::whereIn('course_id', $courseIds)->get();

    return view('student.assignments', compact('assignments'));
}

public function show($id)
{
    $assignment = \App\Models\Assignment::findOrFail($id);

    return view('student.assignments.show', compact('assignment'));
}
}