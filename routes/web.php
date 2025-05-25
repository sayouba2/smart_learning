<?php

use App\Http\Controllers\Student\CertificateController;
use App\Http\Controllers\Teacher\{
    DashboardController,};
use App\Http\Controllers\Teacher\{
    CourseController as TeacherCourseController,
    StudentController as TeacherStudentController,
    AssignmentController,
    QuizController as TeacherQuizController,
    DiscussionController,
    RessourceController,
    CertificateController as TeacherCertificateController,
    AnalyticsController,
    CalendarController,
    SettingController,
    SupportController,
    AnnouncementController
};

use App\Http\Controllers\Student\{
    DashboardController as StudentDashboardController,
    CourseController as StudentCourseController,
    CertificateController as StudentCertificateController,
    AssignmentController as StudentAssignmentController,
    QuizController as StudentQuizController,
    ScheduleController as StudentScheduleController,
    ProgressController as StudentProgressController,
    ForumController as StudentForumController,
    ProfileController as StudentProfileController
};

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Api\CourseController as ApiCourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;

use App\Http\Controllers\Teacher\LessonController;
// Page d'accueil publique
Route::get('/', [HomeController::class, 'index'])->name('home');

// Liste des cours publics
Route::get('/courses', [CourseController::class, 'publicIndex'])->name('courses.index');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/about', [AboutController::class, 'show'])->name('about');
/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*--------------------
| Routes Enseignant
|-------------------*/
Route::middleware(['auth', 'role:teacher'])->name('teacher.')->group(function () {
    
    // Dashboard
    Route::get('/teacher/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');
    
    // CRUD Cours
    Route::resource('teacher/courses', TeacherCourseController::class)->names([
        'index'   => 'courses.index',
        'create'  => 'courses.create',
        'store'   => 'courses.store',
        'show'    => 'courses.show', 
        'edit'    => 'courses.edit',
        'update'  => 'courses.update',
        'destroy' => 'courses.destroy'
    ]);
    
    // CRUD Lessons pour chaque cours
    Route::prefix('teacher/courses/{course}')->group(function () {
        Route::resource('lessons', \App\Http\Controllers\Teacher\LessonController::class)
            ->names([
                'index'   => 'lessons.index',
                'create'  => 'lessons.create',
                'store'   => 'lessons.store',
                'show'    => 'lessons.show',
                'edit'    => 'lessons.edit',
                'update'  => 'lessons.update',
                'destroy' => 'lessons.destroy'
            ])
            ->except(['show']); // On exclut la route show si non nécessaire
            
        // Réorganisation des leçons (si besoin)
        Route::post('lessons/reorder', [\App\Http\Controllers\Teacher\LessonController::class, 'reorder'])
             ->name('lessons.reorder');
    });
    
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

//Route::get('/teacher/courses', [CourseController::class, 'index'])->name('teacher.courses.index');


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
    Route::get('/courses', [StudentCourseController::class, 'myCourses'])
         ->name('courses'); // => route('student.courses')
         
    Route::get('/courses/{course}', [StudentCourseController::class, 'show'])
         ->name('courses.show');

    Route::post('/courses/{course}/complete', [StudentCourseController::class, 'complete'])
         ->name('courses.complete');
});



Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/courses/available', [StudentCourseController::class, 'available'])->name('courses.available');
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/courses/{course}/certificate', [CertificateController::class, 'generate'])
        ->name('student.certificate.generate');
});

Route::get('/student/courses/{course}', [StudentCourseController::class, 'show'])
    ->middleware(['auth', 'student']) // ton middleware ici
    ->name('student.courses.show');

Route::prefix('student')->middleware(['auth', 'student'])->group(function () {
    Route::get('courses/{course}/lessons/{lesson}', 
        [\App\Http\Controllers\Student\LessonController::class, 'show'])
        ->name('student.lessons.show');
        
    Route::post('courses/{course}/lessons/{lesson}/toggle-completion', 
        [\App\Http\Controllers\Student\LessonController::class, 'toggleCompletion'])
        ->name('student.lessons.toggle-completion');
});
Route::get('/api/courses/{course}/resources', [ApiCourseController::class, 'resources'])
      ->name('api.course.resources');
Route::get('/api/courses/{course}/progress', [ApiCourseController::class, 'progress'])
       ->name('api.course.progress');



       // Groupe de routes pour l'administration
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    // Dashboard principal
   Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Utilisateurs
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Cours
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);

    // Catégories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

    // Inscriptions
    Route::resource('enrollments', App\Http\Controllers\Admin\EnrollmentController::class);

    // Paiements
    Route::resource('payments', App\Http\Controllers\Admin\PaymentController::class);

    // Quiz
    Route::resource('quizzes', QuizController::class);

    // Certificats
    Route::resource('certificates', App\Http\Controllers\Admin\CertificateController::class);

    // Annonces
    Route::resource('announcements', App\Http\Controllers\Admin\AnnouncementController::class);

    // Paramètres
    Route::resource('settings', App\Http\Controllers\Admin\SettingController::class)->only(['index', 'update']);

    // Rapports
    Route::resource('reports', App\Http\Controllers\Admin\ReportController::class)->only(['index']);
});



Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {

    // Tableau de bord des cours
    Route::resource('courses', CourseController::class);

    Route::resource('announcements', AnnouncementController::class);
    // Gestion des étudiants
    Route::get('students', [TeacherStudentController::class, 'index'])->name('students.index');

    Route::get('assignments/pending', [AssignmentController::class, 'pending'])->name('assignments.pending');
    // Gestion des devoirs
    Route::resource('assignments', AssignmentController::class);

    // Quiz
    Route::resource('quizzes', TeacherQuizController::class);

    // Route personnalisée pour afficher les discussions sans réponse
    Route::get('discussions/unanswered', [DiscussionController::class, 'unanswered'])->name('discussions.unanswered');
    // Discussions
    Route::resource('discussions', DiscussionController::class);

    // Analytiques
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');

    // Calendrier
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');

    // Ressources
    Route::resource('resources', RessourceController::class);
    Route::post('resources/upload', [RessourceController::class, 'upload'])->name('resources.upload');
    // Certificats
    Route::resource('certificates', TeacherCertificateController::class);

    // Paramètres
    Route::get('settings', [SettingController::class, 'index'])->name('settings');

    // Support
    Route::get('support', [SupportController::class, 'index'])->name('support');
});



Route::prefix('student')->name('student.')->middleware(['auth', 'student'])->group(function () {

    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses');
    Route::get('/certificates', [StudentCertificateController::class, 'index'])->name('certificates');
    Route::get('/assignments', [StudentAssignmentController::class, 'index'])->name('assignments');
    Route::get('/quizzes', [StudentQuizController::class, 'index'])->name('quizzes');
    Route::get('/schedule', [StudentScheduleController::class, 'index'])->name('schedule');
    Route::get('/progress', [StudentProgressController::class, 'index'])->name('progress');
    Route::get('/forum', [StudentForumController::class, 'index'])->name('forum');
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile');
});

require __DIR__.'/auth.php';
