<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // Afficher le formulaire de création de leçons
    public function create(Course $course)
    {
        return view('teacher.lessons.create', compact('course'));
    }

    // Enregistrer une nouvelle leçon
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $lesson = new Lesson([
            'title' => $request->title,
            'content' => $request->content,
            'course_id' => $course->id,
        ]);

        $lesson->save();

        return redirect()->route('teacher.lessons.create', $course)->with('success', 'Leçon créée avec succès !');
    }
}
