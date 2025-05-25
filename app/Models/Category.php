<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    // Une catégorie a plusieurs cours
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
