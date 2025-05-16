<?php

use App\Http\Controllers\Teacher\{CourseController, DashboardController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:teacher'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');
    
    // Ressources Cours
    Route::resource('courses', CourseController::class)->except(['show']);
    
    // Statistiques
    Route::get('/courses/{course}/stats', [DashboardController::class, 'stats'])
         ->name('courses.stats');
});