<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->get();
        $enrolledCourseIds = Auth::check()
            ? Auth::user()->enrollments()->pluck('course_id')->toArray()
            : [];

        return view('courses.index', compact('courses', 'enrolledCourseIds'));
    }

        // Afficher le formulaire de création de cours
        public function create()
        {
            return view('teacher.courses.create');
        }
    
        // Enregistrer un nouveau cours
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
            
            $course = Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'duration' => $request->duration,
                'level' => $request->level,
                'category_id' => $request->category_id,
                'teacher_id' => Auth::id(),
            ]);
            
            return redirect()->route('teacher.courses.index')->with('success', 'Cours créé avec succès !');
            
        }
 public function show(Course $course)
{
    $course->load('resources'); // charge les ressources du cours

    $enrollment = null;
    if (Auth::check()) {
        $enrollment = Auth::user()->enrollments()
            ->where('course_id', $course->id)
            ->first(); // peut être null si pas inscrit
    }

    $enrollmentCount = $course->enrollments()->count();

   return view('courses.show', compact('course', 'enrollment', 'enrollmentCount'));
}


}

