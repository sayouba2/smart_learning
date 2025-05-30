<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total des entités
        $totalUsers = \App\Models\User::count();
        $totalCourses = Course::count();

        // Génération des 12 derniers mois
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $months->push(now()->subMonths($i)->startOfMonth());
        }

        // Graphique des inscriptions mensuelles
        $enrollments = Enrollment::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month_year'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', $months->first())
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->pluck('count', 'month_year');

        $enrollmentsChartLabels = $months->map(fn ($date) => $date->format('M Y'));
        $enrollmentsChartData = $months->map(function ($date) use ($enrollments) {
            $key = $date->format('Y-m');
            return $enrollments[$key] ?? 0;
        });

        // Graphique des revenus par mois
        $payments = Payment::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month_year'),
                DB::raw('SUM(amount) as total')
            )
            ->where('created_at', '>=', $months->first())
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->pluck('total', 'month_year');

        $revenueChartLabels = $enrollmentsChartLabels;
        $revenueChartData = $months->map(function ($date) use ($payments) {
            $key = $date->format('Y-m');
            return $payments[$key] ?? 0;
        });

        // Graphique des cours par catégorie
        $categories = Category::withCount('courses')->having('courses_count', '>', 0)->get();
        $coursesChartLabels = $categories->pluck('name');
        $coursesChartData = $categories->pluck('courses_count');

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalCourses' => $totalCourses,
            'enrollmentsChartLabels' => $enrollmentsChartLabels,
            'enrollmentsChartData' => $enrollmentsChartData,
            'revenueChartLabels' => $revenueChartLabels,
            'revenueChartData' => $revenueChartData,
            'coursesChartLabels' => $coursesChartLabels,
            'coursesChartData' => $coursesChartData,
        ]);
    }
}