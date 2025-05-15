<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Courses
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Authentication routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student routes
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/student/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::get('/my-courses', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/my-courses/{course}', [EnrollmentController::class, 'show'])->name('enrollments.show');

    // Course lessons
    Route::get('/courses/{course}/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
    Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete');

    // Teacher routes
    Route::middleware('role:teacher')->group(function () {
        Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
        Route::resource('teacher/courses', CourseController::class)->except(['index', 'show']);
        Route::resource('teacher/courses.lessons', LessonController::class)->except(['show']);
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
    });
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Cours
Route::resource('courses', CourseController::class);
Route::post('courses/{course}/publish', [CourseController::class, 'togglePublish'])
    ->middleware(['auth', 'role:teacher,admin'])
    ->name('courses.publish');

// Leçons
Route::resource('courses.lessons', LessonController::class)->shallow();
Route::post('courses/{course}/lessons/reorder', [LessonController::class, 'reorder'])
    ->middleware(['auth', 'role:teacher,admin'])
    ->name('courses.lessons.reorder');
Route::post('courses/{course}/lessons/{lesson}/complete', [LessonController::class, 'complete'])
    ->middleware(['auth', 'role:student'])
    ->name('lessons.complete');

// Inscriptions
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('courses.enroll');
    Route::delete('courses/{course}/unenroll', [EnrollmentController::class, 'unenroll'])->name('courses.unenroll');
    Route::get('my-courses', [EnrollmentController::class, 'myCourses'])->name('enrollments.my-courses');
    Route::get('courses/{course}/progress', [EnrollmentController::class, 'showProgress'])->name('enrollments.progress');
    
    // Add the missing enroll route
    Route::post('courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enroll');
});

// Paiements
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('courses/{course}/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('courses/{course}/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('courses/{course}/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});
Route::post('webhook/stripe', [PaymentController::class, 'webhook'])->name('payment.webhook');

// Certificats
Route::middleware('auth')->group(function () {
    Route::get('certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('courses/{course}/certificate/generate', [CertificateController::class, 'generate'])
        ->middleware('role:student')
        ->name('certificates.generate');
    Route::get('certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::get('certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
});
Route::get('certificates/verify/{number}', [CertificateController::class, 'verify'])->name('certificates.verify');

// Ratings
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('courses/{course}/rate', [RatingController::class, 'store'])->name('courses.rate');
    Route::put('courses/{course}/rate', [RatingController::class, 'update'])->name('courses.rate.update');
    Route::delete('courses/{course}/rate', [RatingController::class, 'destroy'])->name('courses.rate.destroy');
});


