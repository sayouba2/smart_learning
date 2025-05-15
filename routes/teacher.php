<?php

use App\Http\Controllers\Teacher\{CourseController, DashboardController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:teacher'])
     ->prefix('teacher')
     ->name('teacher.')
     ->group(function () {
         
         // Dashboard (avec stats)
         Route::get('/dashboard', [DashboardController::class, 'index'])
              ->name('dashboard');
         
         // CRUD Cours
         Route::resource('courses', CourseController::class)->names([
             'index'   => 'courses.index',
             'create'  => 'courses.create',
             'store'   => 'courses.store',
             'show'    => 'courses.show',
             'edit'    => 'courses.edit',
             'update'  => 'courses.update',
             'destroy' => 'courses.destroy'
         ]);
         
         // Statistiques supplémentaires (pour le graphique)
         Route::get('/courses/{course}/stats', [DashboardController::class, 'courseStats'])
              ->name('courses.stats');
     });