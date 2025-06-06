<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Pivot
{
    use HasFactory;

    protected $table = 'enrollments';

    protected $fillable = [
        'user_id',
        'course_id',
        'completed_at',
    ];

    protected $dates = ['completed_at'];

    /**
     * L'utilisateur inscrit.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function student()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Le cours auquel l'utilisateur est inscrit.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
