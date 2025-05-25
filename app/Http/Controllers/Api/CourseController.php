<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    public function resources(Course $course)
    {
        return response()->json($course->resources);
    }
    
    public function progress(Course $course)
    {
        $completed = Auth::user()->completedLessons()
                        ->where('course_id', $course->id)
                        ->count();
        
        $progress = $course->lessons->count() > 0 
                  ? round(($completed / $course->lessons->count()) * 100)
                  : 0;
        
        return response()->json(['progress' => $progress]);
    }
}