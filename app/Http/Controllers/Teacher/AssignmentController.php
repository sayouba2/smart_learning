<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('teacher_id', Auth::id())->latest()->paginate(10);
        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $courses = Course::where('user_id', Auth::id())->get();
        return view('teacher.assignments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data['teacher_id'] = Auth::id();

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('assignments');
        }

        Assignment::create($data);

        return redirect()->route('teacher.assignments.index')->with('success', 'Devoir créé avec succès.');
    }

    public function show(Assignment $assignment)
    {
        $this->authorizeAssignment($assignment);
        return view('teacher.assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        $this->authorizeAssignment($assignment);
        $courses = Course::where('user_id', Auth::id())->get();
        return view('teacher.assignments.edit', compact('assignment', 'courses'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $this->authorizeAssignment($assignment);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            // Supprimer l'ancien fichier si présent
            if ($assignment->file_path) {
                Storage::delete($assignment->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('assignments');
        }

        $assignment->update($data);

        return redirect()->route('teacher.assignments.index')->with('success', 'Devoir mis à jour.');
    }

    public function destroy(Assignment $assignment)
    {
        $this->authorizeAssignment($assignment);

        if ($assignment->file_path) {
            Storage::delete($assignment->file_path);
        }

        $assignment->delete();

        return redirect()->route('teacher.assignments.index')->with('success', 'Devoir supprimé.');
    }

    private function authorizeAssignment(Assignment $assignment)
    {
        abort_if($assignment->teacher_id !== Auth::id(), 403);
    }

    public function pending()
{
    $assignments = Assignment::where('teacher_id', Auth::id())
        ->whereDate('due_date', '>=', now())
        ->orderBy('due_date')
        ->get();

    return view('teacher.assignments.pending', compact('assignments'));
}

}
