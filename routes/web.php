<?php

use App\Http\Livewire\TeacherCourseStats;
use App\Http\Controllers\Teacher\{
    DashboardController,};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Pour l'admin seulement
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'show']);
});

/*--------------------
| Routes Enseignant
|-------------------*/
Route::middleware(['auth', 'role:teacher'])->name('teacher.')->group(function () {
    
    // Dashboard
    Route::get('/teacher/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');
    
    // CRUD Cours
    Route::resource('teacher/courses', CourseController::class)->names([
        'index'   => 'courses.index',
        'create'  => 'courses.create',
        'store'   => 'courses.store',
        'show'    => 'courses.show', 
        'edit'    => 'courses.edit',
        'update'  => 'courses.update',
        'destroy' => 'courses.destroy'
    ]);
    
    // Statistiques
    Route::get('/teacher/courses/{course}/stats', [DashboardController::class, 'stats'])
         ->name('courses.stats');
});

// Pour les étudiants seulement
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'show']);
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');


Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])
         ->name('enroll');
         
    Route::post('/courses/{course}/complete', [EnrollmentController::class, 'complete'])
         ->name('courses.complete');
});

Route::get('/teacher/courses', [CourseController::class, 'index'])->name('teacher.courses.index');


Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])
         ->name('student.dashboard');
});

// Ajoute ceci dans web.php
Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default => abort(403)
    };
})->middleware(['auth'])->name('dashboard');

// Route pour afficher un cours spécifique
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// routes pour le dashboard etudiant
Route::middleware(['auth', 'role:student'])->name('student.')->prefix('student')->group(function () {
    Route::get('/courses', [\App\Http\Controllers\Student\CourseController::class, 'myCourses'])
         ->name('courses'); // => route('student.courses')
         
    Route::get('/courses/{course}', [\App\Http\Controllers\Student\CourseController::class, 'show'])
         ->name('courses.show');

    Route::post('/courses/{course}/complete', [\App\Http\Controllers\Student\CourseController::class, 'complete'])
         ->name('courses.complete');
});

require __DIR__.'/auth.php';
