<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['name', 'url', 'icon', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
