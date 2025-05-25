<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
