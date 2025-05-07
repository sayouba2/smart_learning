<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création des utilisateurs
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $teacher = User::create([
            'name' => 'Professeur',
            'email' => 'teacher@example.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'email_verified_at' => now(),
            'bio' => 'Professeur expérimenté en culture digitale',
        ]);

        $student = User::create([
            'name' => 'Étudiant',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'email_verified_at' => now(),
        ]);

        // Création des cours
        $courses = [
            [
                'title' => 'Introduction à la Culture Digitale',
                'description' => 'Un cours complet sur les fondamentaux de la culture digitale',
                'price' => 0.00,
                'level' => 'beginner',
            ],
            [
                'title' => 'Transformation Digitale des Entreprises',
                'description' => 'Comprendre les enjeux de la transformation digitale',
                'price' => 49.99,
                'level' => 'intermediate',
            ],
        ];

        foreach ($courses as $courseData) {
            $course = Course::create([
                'title' => $courseData['title'],
                'slug' => Str::slug($courseData['title']),
                'description' => $courseData['description'],
                'teacher_id' => $teacher->id,
                'price' => $courseData['price'],
                'is_published' => true,
                'category' => 'Culture Digitale',
                'level' => $courseData['level'],
            ]);

            // Création des leçons pour chaque cours
            for ($i = 1; $i <= 5; $i++) {
                Lesson::create([
                    'title' => "Leçon $i - " . $course->title,
                    'slug' => Str::slug("Leçon $i - " . $course->title),
                    'content' => "Contenu de la leçon $i du cours " . $course->title,
                    'course_id' => $course->id,
                    'order' => $i,
                    'duration' => rand(15, 60),
                    'is_free' => $i === 1,
                ]);
            }
        }
    }
}
