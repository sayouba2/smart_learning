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

        // Graphique des inscriptions mensuelles (12 derniers mois)
        $enrollments = Enrollment::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $months = collect(range(0, 11))->map(function ($i) {
            return now()->subMonths(11 - $i)->format('M');
        });

        $enrollmentsChartLabels = $months->toArray();
        $enrollmentsChartData = $months->map(function ($label, $i) use ($enrollments) {
            $targetMonth = now()->subMonths(11 - $i);
            $match = $enrollments->first(function ($e) use ($targetMonth) {
                return $e->month == $targetMonth->month && $e->year == $targetMonth->year;
            });
            return $match ? $match->count : 0;
        });

        // Graphique des revenus par mois (12 derniers mois)
        $payments = Payment::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(amount) as total')
            )
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $revenueChartLabels = $months->toArray();
        $revenueChartData = $months->map(function ($label, $i) use ($payments) {
            $targetMonth = now()->subMonths(11 - $i);
            $match = $payments->first(function ($p) use ($targetMonth) {
                return $p->month == $targetMonth->month && $p->year == $targetMonth->year;
            });
            return $match ? round($match->total, 2) : 0;
        });

        // Graphique des cours par catégorie
        $categories = Category::withCount('courses')->get();
        $coursesChartLabels = $categories->pluck('name');
        $coursesChartData = $categories->pluck('courses_count');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCourses',
            'enrollmentsChartLabels',
            'enrollmentsChartData',
            'revenueChartLabels',
            'revenueChartData',
            'coursesChartLabels',
            'coursesChartData'
        ));
    }
}
