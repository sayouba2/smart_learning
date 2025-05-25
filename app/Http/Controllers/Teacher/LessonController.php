<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index(Course $course)
{
    if ($course->teacher_id !== Auth::id()) {
        abort(403, 'Vous n\'êtes pas autorisé à accéder à ce cours.');
    }

    $lessons = $course->lessons;

    return view('teacher.lessons.index', compact('course', 'lessons'));
}


    public function create(Course $course)
    {
       $this->authorize('update', $course);
        return view('teacher.lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
{
    $this->authorize('update', $course);
    
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'duration' => 'required|integer|min:1',
        'order' => 'sometimes|integer'
    ]);

    $course->lessons()->create($validated);

    return redirect()->route('teacher.lessons.index', $course)
        ->with('success', 'Lesson créée avec succès');
}


    public function edit(Course $course, Lesson $lesson)
    {
        $this->authorize('update', $lesson);
        return view('teacher.lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $this->authorize('update', $lesson);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'duration' => 'required|integer|min:1',
            'order' => 'sometimes|integer'
        ]);

        $lesson->update($validated);

        return redirect()->route('teacher.lessons.index', $course)
            ->with('success', 'Lesson mise à jour avec succès');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $this->authorize('delete', $lesson);
        $lesson->delete();
        return back()->with('success', 'Lesson supprimée avec succès');
    }
}