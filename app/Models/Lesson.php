<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'content', 'order', 'course_id'];

    public function course() {
       return $this->belongsTo(Course::class);
    }

    public function completedUsers()
{
    return $this->belongsToMany(User::class, 'lesson_completions')
                ->withPivot('completed_at')
                ->withTimestamps();
}
}
