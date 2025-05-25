<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'duration', 
        'level', 'teacher_id', 'category_id'
    ];
    
    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
    
// app/Models/Course.php
public function students()
{
    return $this->belongsToMany(User::class, 'enrollments','course_id', 'user_id')
                ->withPivot('completed_at')
                ->withTimestamps();
}

public function enrollments()
{
    return $this->belongsToMany(User::class, 'enrollments')
                ->withPivot('completed_at')
                ->withTimestamps();
}

public function reviews()
{
    return $this->hasMany(Review::class);
}

public function resources()
{
    return $this->hasMany(Resource::class);
}
public function priceText()
{
    if ($this->price == 0 || is_null($this->price)) {
        return 'Gratuit';
    }

    return number_format($this->price, 2, ',', ' ') . ' €';
}

}
