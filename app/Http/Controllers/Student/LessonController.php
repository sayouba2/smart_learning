<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Afficher une leçon et marquer comme vue
     */
    public function show(Course $course, Lesson $lesson)
    {
        // Vérifier que l'étudiant est inscrit au cours
        if (!Auth::user()->enrolledCourses->contains($course->id)) {
            abort(403, 'Vous n\'êtes pas inscrit à ce cours.');
        }

        // Marquer la leçon comme vue (sans la compléter)
        Auth::user()->viewedLessons()->syncWithoutDetaching([$lesson->id]);

        // Récupérer les données de progression
        $completedLessons = Auth::user()->completedLessons()
            ->where('course_id', $course->id)
            ->pluck('lesson_id');

        $isCompleted = $completedLessons->contains($lesson->id);
        $previousLesson = $course->lessons()
            ->where('order', '<', $lesson->order)
            ->orderBy('order', 'desc')
            ->first();
        
        $nextLesson = $course->lessons()
            ->where('order', '>', $lesson->order)
            ->orderBy('order')
            ->first();

        return view('student.lessons.show', [
            'course' => $course,
            'lesson' => $lesson,
            'isCompleted' => $isCompleted,
            'previousLesson' => $previousLesson,
            'nextLesson' => $nextLesson
        ]);
    }

    /**
     * Marquer/démarquer une leçon comme terminée
     */
    public function toggleCompletion(Course $course, Lesson $lesson)
    {
        if (!Auth::user()->enrolledCourses->contains($course->id)) {
            abort(403);
        }

        $user = Auth::user();

        if ($user->completedLessons()->where('lesson_id', $lesson->id)->exists()) {
            // Si déjà complétée, on retire
            $user->completedLessons()->detach($lesson->id);
            $message = 'Leçon marquée comme non terminée';
        } else {
            // Sinon on marque comme complétée
            $user->completedLessons()->attach($lesson->id, [
                'completed_at' => now(),
                'course_id' => $course->id // On stocke aussi le cours pour faciliter les requêtes
            ]);
            $message = 'Leçon marquée comme terminée';
        }

        // Mettre à jour la progression globale du cours si nécessaire
        $this->updateCourseProgress($course);

        return back()->with('status', $message);
    }

    /**
     * Mettre à jour la progression globale du cours
     */
    protected function updateCourseProgress(Course $course)
    {
        $user = Auth::user();
        $totalLessons = $course->lessons->count();
        $completedLessons = $user->completedLessons()
            ->where('course_id', $course->id)
            ->count();

        // Si toutes les leçons sont complétées, marquer le cours comme terminé
        if ($completedLessons === $totalLessons && $totalLessons > 0) {
            $user->enrolledCourses()
                ->updateExistingPivot($course->id, [
                    'completed_at' => now()
                ]);
        } else {
            // Sinon s'assurer que le cours n'est pas marqué comme terminé
            $user->enrolledCourses()
                ->updateExistingPivot($course->id, [
                    'completed_at' => null
                ]);
        }
    }
}