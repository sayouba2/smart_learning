<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupère 3 cours populaires
        $featuredCourses = Course::query()
            ->where('is_featured', true)
            ->with('teacher')
            ->limit(3)
            ->get();

        return view('home', [
            'featuredCourses' => $featuredCourses,
            'stats' => [
                'totalStudents' => 12543,
                'totalCourses' => Course::count(),
                'successRate' => 98.7
            ]
        ]);
    }
}