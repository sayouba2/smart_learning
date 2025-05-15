<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use App\Models\Course;

class TeacherCourseStats extends Component
{
    public function render()
    {
        $teacherId = Auth::id();
    
        $courses = Course::where('teacher_id', $teacherId)
            ->withCount('students')
            ->orderByDesc('students_count')
            ->take(5)
            ->get();
    
        $chart = (new ColumnChartModel())
            ->setTitle('Cours les plus inscrits')
            ->setAnimated(true)
            ->withDataLabels()
            ->setColors(['#34D399'])
            ->setXAxisVisible(true)
            ->setYAxisVisible(true);
    
        foreach ($courses as $course) {
            // Limitez la longueur du titre pour un meilleur affichage
            $shortTitle = strlen($course->title) > 20 
                ? substr($course->title, 0, 17).'...' 
                : $course->title;
                
            $chart->addColumn($shortTitle, $course->students_count, '#34D399');
        }
    
        return view('livewire.teacher-course-stats', [
            'columnChartModel' => $chart,
        ]);
    }
}
