<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

    Route::prefix('students')->group(function () {
        Route::get('/create', fn () => view('student.create'))->name('students.create');
        Route::post('/', [StudentController::class, 'store'])->name('students.store');
        Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    Route::prefix('teachers')->group(function () {
        Route::get('/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    });
});
