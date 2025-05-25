<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('teacher_id', Auth::id())->with('course')->get();
        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.assignments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'file' => 'nullable|file|mimes:pdf,docx,doc|max:2048'
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('assignments');
        }

        $data['teacher_id'] = Auth::id();
        Assignment::create($data);

        return redirect()->route('teacher.assignments.index')->with('success', 'Devoir créé avec succès.');
    }
}
