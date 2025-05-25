<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\DashboardController;

Route::middleware(['auth', 'role:teacher'])->name('teacher.')->group(function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('teacher/courses', TeacherCourseController::class)->names([
        'index'   => 'courses.index',
        'create'  => 'courses.create',
        'store'   => 'courses.store',
        'show'    => 'courses.show',
        'edit'    => 'courses.edit',
        'update'  => 'courses.update',
        'destroy' => 'courses.destroy'
    ]);

    Route::get('/teacher/courses/{course}/stats', [DashboardController::class, 'stats'])->name('courses.stats');
});
