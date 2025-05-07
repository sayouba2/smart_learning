<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // Méthodes pour vérifier le rôle
public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function isTeacher(): bool
{
    return $this->role === 'teacher';
}

// Pour les enseignants
public function courses() {
    return $this->hasMany(Course::class, 'teacher_id');
}

// Pour les étudiants
public function enrolledCourses() {
    return $this->belongsToMany(Course::class, 'enrollments')
                ->withPivot('completed_at');
}

public function completedCourses()
{
    return $this->belongsToMany(Course::class, 'enrollments')
                ->wherePivotNotNull('completed_at')
                ->withPivot('completed_at');
}

public function inProgressCourses()
{
    return $this->belongsToMany(Course::class, 'enrollments')
                ->wherePivotNull('completed_at');
}

public function enrollments()
{
    return $this->belongsToMany(User::class, 'enrollments')
                ->withPivot('completed_at')
                ->withTimestamps();
}
}