<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

   /* public function __construct()
{
    $this->authorizeResource(Course::class, 'course');
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Auth::user()->courses()->with('category')->get();
        return view('teacher.courses.index', compact('courses'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('teacher.courses.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'level' => 'required|in:débutant,intermédiaire,avancé',
            'category_id' => 'required|exists:categories,id'
        ]);
    
        Auth::user()->courses()->create($validated);
    
        return redirect()->route('teacher.courses.index');
    }
    
    public function destroy(Course $course)
    {
        // Empêche la suppression si des étudiants sont inscrits
        if ($course->students()->exists()) {
            return back()->withErrors([
                'message' => 'Impossible de supprimer un cours avec des étudiants inscrits'
            ]);
        }
    
        $course->delete();
        return redirect()->route('teacher.courses.index');
    }
    public function show(Course $course)
    {
        // Vérifie que l'enseignant est bien propriétaire du cours (via Policy)
        $this->authorize('view', $course);
    
        // Charge les données nécessaires
        $course->load([
            'students' => function($query) {
                $query->orderBy('enrollments.created_at', 'desc');
            },
            'lessons',
            'category'
        ]);
    
        // Statistiques basiques (à compléter selon vos besoins)
        $stats = [
            'completion_rate' => $this->calculateCompletionRate($course),
            'avg_rating' => $course->reviews()->avg('rating') ?? 0,
            'enrollments_count' => $course->students->count(),
        ];
    
        return view('teacher.courses.show', compact('course', 'stats'));
    }
    
    // Méthode privée pour calculer le taux de complétion
    private function calculateCompletionRate(Course $course): float
    {
        $totalStudents = $course->students->count();
        if ($totalStudents === 0) return 0;
    
        $completedStudents = $course->students()
            ->whereNotNull('enrollments.completed_at')
            ->count();
    
        return round(($completedStudents / $totalStudents) * 100, 2);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course) {
        $this->authorize('update', $course);
        return view('teacher.courses.edit', compact('course'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
}
