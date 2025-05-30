@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.css">
<style>
    .sidebar-active {
        background-color: rgba(59, 130, 246, 0.1);
        border-right: 3px solid #3b82f6;
    }
    .sidebar-active .text-gray-600 {
        color: #3b82f6 !important;
    }
</style>
@endpush

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg flex-shrink-0">
        <div class="p-4 border-b">
            <h2 class="text-xl font-bold text-gray-800">ELearning Admin</h2>
            <p class="text-sm text-gray-500">Panneau d'administration</p>
        </div>
        
        <nav class="mt-4">
            <div class="px-4 py-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Principal</p>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 sidebar-active">
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{-- route('admin.users.index') --}}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-users mr-3"></i>
                <span>Utilisateurs</span>
                <span class="ml-auto bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">{{ $totalUsers ?? 0 }}</span>
            </a>
            
            <a href="{{ route('admin.courses.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-book mr-3"></i>
                <span>Cours</span>
                <span class="ml-auto bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">{{ $totalCourses ?? 0 }}</span>
            </a>
            
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-tags mr-3"></i>
                <span>Catégories</span>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-user-graduate mr-3"></i>
                <span>Inscriptions</span>
            </a>
            
            <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-credit-card mr-3"></i>
                <span>Paiements</span>
            </a>
            
            <div class="px-4 py-2 mt-4">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Contenu</p>
            </div>
            
            <a href="{{ route('admin.quizzes.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-question-circle mr-3"></i>
                <span>Quiz</span>
            </a>
            
            <a href="{{ route('admin.certificates.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-certificate mr-3"></i>
                <span>Certificats</span>
            </a>
            
            <a href="{{ route('admin.announcements.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-bullhorn mr-3"></i>
                <span>Annonces</span>
            </a>
            
            <div class="px-4 py-2 mt-4">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Système</p>
            </div>
            
            <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-cogs mr-3"></i>
                <span>Paramètres</span>
            </a>
            
            <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-chart-line mr-3"></i>
                <span>Rapports</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-hidden">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="flex items-center text-gray-600 hover:text-gray-900">
                                <i class="fas fa-bell mr-2"></i>
                                <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $pendingNotifications ?? 0 }}</span>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2">
                            <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar_url ?? asset('images/default-avatar.png') }}" alt="Avatar">
                            <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="flex-1 overflow-y-auto p-6">
                <!-- Statistiques principales -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Étudiants</p>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $studentCount ?? 0 }}</h3>
                                <p class="text-xs text-green-500 mt-1">+{{ $newStudentsThisMonth ?? 0 }} ce mois</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Enseignants</p>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $teacherCount ?? 0 }}</h3>
                                <p class="text-xs text-green-500 mt-1">+{{ $newTeachersThisMonth ?? 0 }} ce mois</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-chalkboard-teacher text-green-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Cours Actifs</p>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $activeCourses ?? 0 }}</h3>
                                <p class="text-xs text-blue-500 mt-1">{{ $totalCourses ?? 0 }} au total</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-book text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Revenus</p>
                                <h3 class="text-2xl font-bold text-gray-900">{{ number_format($totalRevenue ?? 0, 0, ',', ' ') }} €</h3>
                                <p class="text-xs text-green-500 mt-1">+{{ number_format($revenueThisMonth ?? 0, 0, ',', ' ') }} € ce mois</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-euro-sign text-purple-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques secondaires -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Inscriptions Actives</h4>
                            <i class="fas fa-user-graduate text-indigo-500"></i>
                        </div>
                        <p class="text-3xl font-bold text-gray-900">{{ $activeEnrollments ?? 0 }}</p>
                        <p class="text-sm text-gray-500 mt-2">Taux de completion: {{ $completionRate ?? 0 }}%</p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Quiz Complétés</h4>
                            <i class="fas fa-question-circle text-pink-500"></i>
                        </div>
                        <p class="text-3xl font-bold text-gray-900">{{ $completedQuizzes ?? 0 }}</p>
                        <p class="text-sm text-gray-500 mt-2">Score moyen: {{ $averageQuizScore ?? 0 }}%</p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Certificats Émis</h4>
                            <i class="fas fa-certificate text-orange-500"></i>
                        </div>
                        <p class="text-3xl font-bold text-gray-900">{{ $issuedCertificates ?? 0 }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $certificatesThisMonth ?? 0 }} ce mois</p>
                    </div>
                </div>

                <!-- Graphiques -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Graphique Inscriptions -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Inscriptions par mois</h3>
                        <canvas id="enrollmentsChart" height="250" ></canvas>
                    </div>

                    <!-- Graphique Revenus -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Revenus par mois</h3>
                        <canvas id="revenueChart" height="250"></canvas>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Graphique Cours par catégorie -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Répartition des cours</h3>
                        <canvas id="coursesChart" height="250"></canvas>
                    </div>

                    <!-- Activité récente -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Activité récente</h3>
                        <div class="space-y-4">
                            @if(isset($recentActivities) && count($recentActivities) > 0)
                                @foreach($recentActivities as $activity)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-{{ $activity->icon ?? 'info' }} text-blue-500 text-xs"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $activity->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $activity->description }}</p>
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <p class="text-gray-500 text-center py-4">Aucune activité récente</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Top Cours et Top Enseignants -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Top Cours -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b">
                            <h3 class="text-lg font-semibold">Cours les plus populaires</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @if(isset($topCourses) && count($topCourses) > 0)
                                @foreach($topCourses as $course)
                                <div class="p-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <img class="h-12 w-12 rounded object-cover" src="{{ $course->thumbnail_url ?? asset('images/default-course.png') }}" alt="">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $course->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $course->enrollments_count ?? 0 }} inscrits</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-green-600">{{ $course->rating ?? 0 }}/5</span>
                                </div>
                                @endforeach
                            @else
                                <div class="p-4 text-center text-gray-500">Aucun cours disponible</div>
                            @endif
                        </div>
                    </div>

                    <!-- Top Enseignants -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b">
                            <h3 class="text-lg font-semibold">Enseignants performants</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @if(isset($topTeachers) && count($topTeachers) > 0)
                                @foreach($topTeachers as $teacher)
                                <div class="p-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <img class="h-10 w-10 rounded-full" src="{{ $teacher->avatar_url ?? asset('images/default-avatar.png') }}" alt="">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $teacher->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $teacher->courses_count ?? 0 }} cours</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">{{ $teacher->students_count ?? 0 }} étudiants</p>
                                        <p class="text-xs text-gray-500">{{ $teacher->average_rating ?? 0 }}/5</p>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="p-4 text-center text-gray-500">Aucun enseignant disponible</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Actions rapides</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('admin.users.create') }}" class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <i class="fas fa-user-plus text-blue-500 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-blue-700">Ajouter Étudiant</span>
                        </a>
                        
                        <a href="{{ route('admin.users.create') }}" class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                            <i class="fas fa-chalkboard-teacher text-green-500 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-green-700">Ajouter Enseignant</span>
                        </a>
                        
                        <a href="{{ route('admin.courses.create') }}" class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                            <i class="fas fa-plus text-yellow-500 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-yellow-700">Nouveau Cours</span>
                        </a>
                        
                        <a href="{{ route('admin.announcements.create') }}" class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                            <i class="fas fa-bullhorn text-purple-500 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-purple-700">Nouvelle Annonce</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuration globale des graphiques
        Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
        Chart.defaults.color = '#6B7280';

        // Vérification des données
        console.log('Enrollments Data:', @json($enrollmentsChartData));
        console.log('Enrollments Labels:', @json($enrollmentsChartLabels));

        // Graphique des inscriptions
        const enrollmentsCtx = document.getElementById('enrollmentsChart');
        if (enrollmentsCtx) {
            new Chart(enrollmentsCtx, {
                type: 'line',
                data: {
                    labels: @json($enrollmentsChartLabels),
                    datasets: [{
                        label: 'Inscriptions',
                        data: @json($enrollmentsChartData),
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Graphique des revenus
        const revenueCtx = document.getElementById('revenueChart');
        if (revenueCtx) {
            new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: @json($revenueChartLabels),
                    datasets: [{
                        label: 'Revenus (€)',
                        data: @json($revenueChartData),
                        backgroundColor: 'rgba(16, 185, 129, 0.7)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Graphique des cours par catégorie
        const coursesCtx = document.getElementById('coursesChart');
        if (coursesCtx) {
            new Chart(coursesCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($coursesChartLabels),
                    datasets: [{
                        data: @json($coursesChartData),
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(236, 72, 153, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush