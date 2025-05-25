<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher', 'category')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string',
            'level' => 'required|string|in:beginner,intermediate,advanced',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'level' => $request->level,
            'category_id' => $request->category_id,
            'teacher_id' => Auth::id(), // ou null si admin crée
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Cours créé avec succès !');
    }

    public function show(Course $course)
    {
        $course->load(['teacher', 'category', 'lessons', 'resources']);
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string',
            'level' => 'required|string|in:beginner,intermediate,advanced',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Cours mis à jour.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Cours supprimé.');
    }
}
