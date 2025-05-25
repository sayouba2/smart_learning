<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['user_id', 'course_id', 'issued_at'];

    // Un certificat appartient à un étudiant
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un certificat appartient à un cours
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
