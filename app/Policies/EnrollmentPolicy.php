<?php

namespace App\Policies;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;

class EnrollmentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function enroll(User $user, Course $course)
    {
        return $user->role === 'student';
      

    }
    
    
    public function complete(User $user, Course $course)
    {
        return $user->enrolledCourses()
                    ->where('course_id', $course->id)
                    ->whereNull('completed_at')
                    ->exists();
    }
    
}
