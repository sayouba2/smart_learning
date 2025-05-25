@extends('layouts.student')

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="student-profile">
                <div class="profile-avatar">
                    <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=4361ee&color=fff' }}" 
                         alt="{{ auth()->user()->name }}">
                </div>
                <div class="profile-info">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p>{{ auth()->user()->email }}</p>
                    <span class="student-level">Niveau {{ auth()->user()->level ?? 'Débutant' }}</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('student.dashboard') }}" class="nav-item active">
                <i class="fas fa-home"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="{{ route('student.courses') }}" class="nav-item">
                <i class="fas fa-book-open"></i>
                <span>Mes Cours</span>
                <span class="nav-badge">{{ count($inProgressCourses) + count($completedCourses) }}</span>
            </a>
            <a href="{{ route('student.certificates') }}" class="nav-item">
                <i class="fas fa-medal"></i>
                <span>Certificats</span>
                <span class="nav-badge">{{ count($certificates) }}</span>
            </a>
            <a href="{{ route('student.assignments') }}" class="nav-item">
                <i class="fas fa-tasks"></i>
                <span>Devoirs</span>
                @if(isset($pendingAssignments) && count($pendingAssignments) > 0)
                <span class="nav-badge urgent">{{ count($pendingAssignments) }}</span>
                @endif
            </a>
            <a href="{{ route('student.quizzes') }}" class="nav-item">
                <i class="fas fa-question-circle"></i>
                <span>Quiz</span>
            </a>
            <a href="{{ route('student.schedule') }}" class="nav-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Planning</span>
            </a>
            <a href="{{ route('student.progress') }}" class="nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Progression</span>
            </a>
            <a href="{{ route('student.forum') }}" class="nav-item">
                <i class="fas fa-comments"></i>
                <span>Forum</span>
                @if(isset($unreadMessages) && $unreadMessages > 0)
                <span class="nav-badge">{{ $unreadMessages }}</span>
                @endif
            </a>
            <a href="{{ route('student.profile') }}" class="nav-item">
                <i class="fas fa-user-cog"></i>
                <span>Profil</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="progress-summary">
                <h4>Progression Globale</h4>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $globalProgress ?? 45 }}%"></div>
                </div>
                <span class="progress-text">{{ $globalProgress ?? 45 }}% terminé</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="content-header">
            <div class="header-left">
                <h1>Tableau de bord</h1>
                <p>Bonjour {{ auth()->user()->name }}, voici un résumé de vos activités</p>
            </div>
            <div class="header-right">
                <div class="quick-stats">
                    <div class="stat-item">
                        <i class="fas fa-clock text-warning"></i>
                        <span>{{ $todayStudyTime ?? '2h 30min' }}</span>
                        <small>Aujourd'hui</small>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-fire text-danger"></i>
                        <span>{{ $studyStreak ?? 7 }}</span>
                        <small>Jours consécutifs</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ count($inProgressCourses) }}</h3>
                        <p>Cours en cours</p>
                        <small>+{{ $newCoursesThisWeek ?? 2 }} cette semaine</small>
                    </div>
                </div>

                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ count($completedCourses) }}</h3>
                        <p>Cours terminés</p>
                        <small>{{ $completionRate ?? 75 }}% de réussite</small>
                    </div>
                </div>

                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ count($pendingAssignments ?? []) }}</h3>
                        <p>Devoirs en attente</p>
                        @if(count($pendingAssignments ?? []) > 0)
                        <small class="urgent">{{ count($urgentAssignments ?? []) }} urgent(s)</small>
                        @else
                        <small>Tout est à jour!</small>
                        @endif
                    </div>
                </div>

                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalPoints ?? 1250 }}</h3>
                        <p>Points gagnés</p>
                        <small>Rang: {{ $studentRank ?? '#12' }}</small>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Upcoming -->
            <div class="activity-section">
                <div class="recent-activity">
                    <div class="section-header">
                        <h2><i class="fas fa-history"></i> Activité Récente</h2>
                    </div>
                    <div class="activity-list">
                        @forelse($recentActivities ?? [] as $activity)
                        <div class="activity-item">
                            <div class="activity-icon {{ $activity['type'] }}">
                                <i class="fas {{ $activity['icon'] }}"></i>
                            </div>
                            <div class="activity-content">
                                <p>{{ $activity['description'] }}</p>
                                <small>{{ $activity['time'] }}</small>
                            </div>
                        </div>
                        @empty
                        <div class="activity-item">
                            <div class="activity-icon completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="activity-content">
                                <p>Cours "Introduction au Web" terminé</p>
                                <small>Il y a 2 heures</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon started">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="activity-content">
                                <p>Démarrage du cours "PHP Avancé"</p>
                                <small>Hier</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon quiz">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <div class="activity-content">
                                <p>Quiz "JavaScript Basics" - Score: 85%</p>
                                <small>Il y a 3 jours</small>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="upcoming-tasks">
                    <div class="section-header">
                        <h2><i class="fas fa-calendar-check"></i> À Venir</h2>
                    </div>
                    <div class="tasks-list">
                        @forelse($upcomingTasks ?? [] as $task)
                        <div class="task-item {{ $task['priority'] }}">
                            <div class="task-date">
                                <span class="day">{{ $task['day'] }}</span>
                                <span class="month">{{ $task['month'] }}</span>
                            </div>
                            <div class="task-content">
                                <h4>{{ $task['title'] }}</h4>
                                <p>{{ $task['description'] }}</p>
                                <small class="task-type">{{ $task['type'] }}</small>
                            </div>
                        </div>
                        @empty
                        <div class="task-item normal">
                            <div class="task-date">
                                <span class="day">28</span>
                                <span class="month">MAI</span>
                            </div>
                            <div class="task-content">
                                <h4>Projet Final Laravel</h4>
                                <p>Remise du projet de fin de module</p>
                                <small class="task-type">Devoir</small>
                            </div>
                        </div>
                        <div class="task-item high">
                            <div class="task-date">
                                <span class="day">30</span>
                                <span class="month">MAI</span>
                            </div>
                            <div class="task-content">
                                <h4>Examen JavaScript</h4>
                                <p>Évaluation sur les concepts avancés</p>
                                <small class="task-type">Examen</small>
                            </div>
                        </div>
                        <div class="task-item normal">
                            <div class="task-date">
                                <span class="day">02</span>
                                <span class="month">JUIN</span>
                            </div>
                            <div class="task-content">
                                <h4>Session Live: React Hooks</h4>
                                <p>Cours en direct avec M. Dubois</p>
                                <small class="task-type">Live</small>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Courses Progress -->
            <div class="courses-progress">
                <div class="section-header">
                    <h2><i class="fas fa-book-open"></i> Mes Cours en Progression</h2>
                    <a href="{{ route('student.courses') }}" class="view-all">Voir tout</a>
                </div>
                
                @if(count($inProgressCourses) > 0)
                <div class="courses-grid">
                    @foreach($inProgressCourses->take(3) as $course)
                    <div class="course-progress-card">
                        <div class="course-image">
                            <img src="{{ $course->image_url ?? 'https://source.unsplash.com/random/300x200?education&sig='.$loop->index }}" 
                                 alt="{{ $course->title }}">
                            <div class="progress-overlay">
                                <div class="circular-progress" data-progress="{{ $course->progress ?? rand(30, 90) }}">
                                    <span>{{ $course->progress ?? rand(30, 90) }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-info">
                            <h3>{{ $course->title }}</h3>
                            <p class="instructor">
                                <i class="fas fa-user-tie"></i> {{ $course->teacher->name }}
                            </p>
                            <div class="course-meta">
                                <span class="duration">
                                    <i class="fas fa-clock"></i> {{ $course->duration ?? '4h 30min' }}
                                </span>
                                <span class="lessons">
                                    <i class="fas fa-play-circle"></i> {{ $course->lessons_count ?? 12 }} leçons
                                </span>
                            </div>
                            <a href="{{ route('student.courses.show', $course) }}" class="continue-btn">
                                <i class="fas fa-play"></i> Continuer
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h3>Aucun cours en progression</h3>
                    <p>Commencez un nouveau cours pour voir votre progression ici</p>
                    <a href="{{ route('courses.index') }}" class="cta-btn">
                        <i class="fas fa-plus"></i> Parcourir les cours
                    </a>
                </div>
                @endif
            </div>

            <!-- Achievements & Certificates -->
            <div class="achievements-certificates">
                <div class="achievements">
                    <div class="section-header">
                        <h2><i class="fas fa-trophy"></i> Succès</h2>
                    </div>
                    <div class="achievements-grid">
                        @forelse($achievements ?? [] as $achievement)
                        <div class="achievement-badge {{ $achievement['earned'] ? 'earned' : 'locked' }}">
                            <div class="badge-icon">
                                <i class="fas {{ $achievement['icon'] }}"></i>
                            </div>
                            <div class="badge-info">
                                <h4>{{ $achievement['title'] }}</h4>
                                <p>{{ $achievement['description'] }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="achievement-badge earned">
                            <div class="badge-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="badge-info">
                                <h4>Premier Pas</h4>
                                <p>Premier cours terminé</p>
                            </div>
                        </div>
                        <div class="achievement-badge earned">
                            <div class="badge-icon">
                                <i class="fas fa-fire"></i>
                            </div>
                            <div class="badge-info">
                                <h4>Série de 7</h4>
                                <p>7 jours consécutifs d'apprentissage</p>
                            </div>
                        </div>
                        <div class="achievement-badge locked">
                            <div class="badge-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="badge-info">
                                <h4>Expert</h4>
                                <p>10 cours terminés</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="recent-certificates">
                    <div class="section-header">
                        <h2><i class="fas fa-medal"></i> Certificats Récents</h2>
                        <a href="{{ route('student.certificates') }}" class="view-all">Voir tout</a>
                    </div>
                    @if(count($certificates) > 0)
                    <div class="certificates-list">
                        @foreach($certificates->take(3) as $cert)
                        <div class="certificate-mini">
                            <div class="cert-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="cert-info">
                                <h4>{{ $cert['course_name'] }}</h4>
                                <p>{{ $cert['completed_at'] ?? 'Récemment' }}</p>
                            </div>
                            <a href="{{ route('student.certificate.generate', ['course' => $cert['course_id'] ?? $cert['id'] ?? null]) }}" class="download-mini">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-certificates">
                        <i class="fas fa-medal"></i>
                        <p>Terminez vos premiers cours pour obtenir des certificats</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #4361ee;
    --primary-light: #e0e7ff;
    --primary-dark: #3f37c9;
    --secondary-color: #7209b7;
    --success-color: #10b981;
    --success-light: #d1fae5;
    --warning-color: #f59e0b;
    --warning-light: #fef3c7;
    --danger-color: #ef4444;
    --danger-light: #fee2e2;
    --info-color: #3b82f6;
    --info-light: #dbeafe;
    --dark-color: #1e293b;
    --light-color: #f8fafc;
    --gray-color: #94a3b8;
    --gray-light: #f1f5f9;
    --border-color: #e2e8f0;
    --sidebar-width: 280px;
}

/* Base Layout */
.dashboard-container {
    display: flex;
    min-height: 100vh;
    background-color: var(--gray-light);
}

/* Sidebar */
.sidebar {
    width: var(--sidebar-width);
    background: white;
    border-right: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100vh;
    left: 0;
    top: 0;
    z-index: 1000;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
}

.sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-color);
}

.student-profile {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.profile-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-info h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 0.25rem 0;
    color: var(--dark-color);
}

.profile-info p {
    font-size: 0.85rem;
    color: var(--gray-color);
    margin: 0 0 0.5rem 0;
}

.student-level {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.sidebar-nav {
    flex: 1;
    padding: 1rem 0;
    overflow-y: auto;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    color: var(--gray-color);
    text-decoration: none;
    transition: all 0.2s ease;
    position: relative;
}

.nav-item:hover {
    background-color: var(--primary-light);
    color: var(--primary-color);
}

.nav-item.active {
    background-color: var(--primary-light);
    color: var(--primary-color);
    border-right: 3px solid var(--primary-color);
}

.nav-item i {
    width: 20px;
    margin-right: 0.75rem;
    font-size: 1rem;
}

.nav-item span:first-of-type {
    flex: 1;
    font-weight: 500;
}

.nav-badge {
    background-color: var(--primary-color);
    color: white;
    font-size: 0.75rem;
    padding: 0.2rem 0.5rem;
    border-radius: 10px;
    font-weight: 600;
}

.nav-badge.urgent {
    background-color: var(--danger-color);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.sidebar-footer {
    padding: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.progress-summary h4 {
    font-size: 1rem;
    margin-bottom: 0.75rem;
    color: var(--dark-color);
}

.progress-bar {
    height: 8px;
    background-color: var(--gray-light);
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    transition: width 0.3s ease;
}

.progress-text {
    font-size: 0.85rem;
    color: var(--gray-color);
}

/* Main Content */
.main-content {
    flex: 1;
    margin-left: var(--sidebar-width);
    padding: 2rem;
    overflow-x: hidden;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border-color);
}

.header-left h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--dark-color);
}

.header-left p {
    color: var(--gray-color);
    font-size: 1.1rem;
}

.quick-stats {
    display: flex;
    gap: 2rem;
}

.stat-item {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.stat-item i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.stat-item span {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--dark-color);
}

.stat-item small {
    color: var(--gray-color);
    font-size: 0.85rem;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 1rem;
    border-left: 4px solid;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
}

.stat-card.primary { border-left-color: var(--primary-color); }
.stat-card.success { border-left-color: var(--success-color); }
.stat-card.warning { border-left-color: var(--warning-color); }
.stat-card.info { border-left-color: var(--info-color); }

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-card.primary .stat-icon { background: var(--primary-color); }
.stat-card.success .stat-icon { background: var(--success-color); }
.stat-card.warning .stat-icon { background: var(--warning-color); }
.stat-card.info .stat-icon { background: var(--info-color); }

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: var(--dark-color);
}

.stat-content p {
    color: var(--gray-color);
    margin-bottom: 0.5rem;
}

.stat-content small {
    font-size: 0.8rem;
    color: var(--success-color);
}

.stat-content small.urgent {
    color: var(--danger-color);
}

/* Activity Section */
.activity-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.recent-activity, .upcoming-tasks {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
}

.section-header h2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark-color);
    display: flex;
    align-items: center;
}

.section-header h2 i {
    margin-right: 0.5rem;
    color: var(--primary-color);
}

.view-all {
    color: var(--primary-color);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
}

.view-all:hover {
    text-decoration: underline;
}

.activity-list, .tasks-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    border-radius: 8px;
    transition: background-color 0.2s ease;
}

.activity-item:hover {
    background-color: var(--gray-light);
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

.activity-icon.completed { background: var(--success-color); }
.activity-icon.started { background: var(--info-color); }
.activity-icon.quiz { background: var(--warning-color); }

.activity-content p {
    margin: 0 0 0.25rem 0;
    color: var(--dark-color);
    font-weight: 500;
}

.activity-content small {
    color: var(--gray-color);
    font-size: 0.85rem;
}

.task-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid;
    background: white;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.task-item.normal { border-left-color: var(--info-color); }
.task-item.high { border-left-color: var(--danger-color); }

.task-date {
    text-align: center;
    min-width: 50px;
}

.task-date .day {
    display: block;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--dark-color);
}

.task-date .month {
    display: block;
    font-size: 0.75rem;
    color: var(--gray-color);
    font-weight: 600;
}

.task-content h4 {
    margin: 0 0 0.25rem 0;
    color: var(--dark-color);
    font-size: 1rem;
}

.task-content p {
    margin: 0 0 0.5rem 0;
    color: var(--gray-color);
    font-size: 0.9rem;
}

.task-type {
    background: var(--primary-light);
    color: var(--primary-color);
    padding: 0.2rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Courses Progress */
.courses-progress {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
}

.course-progress-card {
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: white;
}

.course-progress-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.course-image {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.course-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.course-progress-card:hover .course-image img {
    transform: scale(1.05);
}

.progress-overlay {
    position: absolute;
    top: 1rem;
    right: 1rem;
}

.circular-progress {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: conic-gradient(var(--primary-color) var(--progress, 0%), rgba(255, 255, 255, 0.3) var(--progress, 0%));
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.circular-progress::before {
    content: '';
    position: absolute;
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
}

.circular-progress span {
    position: relative;
    z-index: 1;
    font-weight: 700;
    font-size: 0.8rem;
    color: var(--dark-color);
}

.course-info {
    padding: 1.5rem;
}

.course-info h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--dark-color);
    line-height: 1.3;
}

.instructor {
    color: var(--gray-color);
    font-size: 0.9rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.instructor i {
    margin-right: 0.5rem;
    color: var(--primary-color);
}

.course-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    font-size: 0.85rem;
    color: var(--gray-color);
}

.course-meta span {
    display: flex;
    align-items: center;
}

.course-meta i {
    margin-right: 0.25rem;
    color: var(--primary-color);
}

.continue-btn {
    width: 100%;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    padding: 0.75rem;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.continue-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    color: white;
}

.continue-btn i {
    margin-right: 0.5rem;
}

/* Achievements & Certificates */
.achievements-certificates {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.achievements, .recent-certificates {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.achievements-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

.achievement-badge {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.achievement-badge.earned {
    background: linear-gradient(135deg, var(--success-light), rgba(16, 185, 129, 0.1));
    border-color: var(--success-color);
}

.achievement-badge.locked {
    opacity: 0.5;
    background: var(--gray-light);
}

.achievement-badge:hover.earned {
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);
}

.badge-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
}

.achievement-badge.earned .badge-icon {
    background: var(--success-color);
}

.achievement-badge.locked .badge-icon {
    background: var(--gray-color);
}

.badge-info h4 {
    margin: 0 0 0.25rem 0;
    color: var(--dark-color);
    font-size: 1rem;
}

.badge-info p {
    margin: 0;
    color: var(--gray-color);
    font-size: 0.85rem;
}

.certificates-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.certificate-mini {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    transition: all 0.2s ease;
}

.certificate-mini:hover {
    background: var(--primary-light);
    border-color: var(--primary-color);
}

.cert-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--warning-color), #ff6b35);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.cert-info {
    flex: 1;
}

.cert-info h4 {
    margin: 0 0 0.25rem 0;
    color: var(--dark-color);
    font-size: 0.95rem;
}

.cert-info p {
    margin: 0;
    color: var(--gray-color);
    font-size: 0.8rem;
}

.download-mini {
    width: 35px;
    height: 35px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.download-mini:hover {
    background: var(--primary-dark);
    transform: scale(1.1);
    color: white;
}

.empty-certificates {
    text-align: center;
    padding: 2rem;
    color: var(--gray-color);
}

.empty-certificates i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--border-color);
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--gray-color);
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: var(--border-color);
}

.empty-state h3 {
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.empty-state p {
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

.cta-btn {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
}

.cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    color: white;
}

.cta-btn i {
    margin-right: 0.5rem;
}

/* Responsive Design */
@media (max-width: 1400px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-row {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .achievements-certificates {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 1200px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .sidebar.open {
        transform: translateX(0);
    }
    
    .main-content {
        margin-left: 0;
    }
    
    .activity-section {
        grid-template-columns: 1fr;
    }
    
    .courses-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }
}

@media (max-width: 768px) {
    .main-content {
        padding: 1rem;
    }
    
    .content-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .quick-stats {
        width: 100%;
        justify-content: space-around;
    }
    
    .stats-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .courses-grid {
        grid-template-columns: 1fr;
    }
    
    .achievements-grid {
        grid-template-columns: 1fr;
    }
}

/* Animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card, .course-progress-card, .achievement-badge, .certificate-mini {
    animation: slideInUp 0.5s ease-out;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }

/* Custom Scrollbar */
.sidebar-nav::-webkit-scrollbar {
    width: 4px;
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background: var(--gray-color);
    border-radius: 2px;
}

.sidebar-nav::-webkit-scrollbar-track {
    background: transparent;
}

/* Progress Circles Animation */
@keyframes progressAnimation {
    from {
        background: conic-gradient(var(--primary-color) 0%, rgba(255, 255, 255, 0.3) 0%);
    }
}

.circular-progress[data-progress] {
    animation: progressAnimation 2s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cercles de progression
    const progressCircles = document.querySelectorAll('.circular-progress[data-progress]');
    progressCircles.forEach(circle => {
        const progress = circle.getAttribute('data-progress');
        const percentage = (progress / 100) * 360;
        circle.style.background = `conic-gradient(var(--primary-color) ${percentage}deg, rgba(255, 255, 255, 0.3) ${percentage}deg)`;
    });

    // Sidebar mobile toggle
    const sidebarToggle = document.createElement('button');
    sidebarToggle.innerHTML = '<i class="fas fa-bars"></i>';
    sidebarToggle.className = 'sidebar-toggle';
    sidebarToggle.style.cssText = `
        position: fixed;
        top: 1rem;
        left: 1rem;
        z-index: 1001;
        background: var(--primary-color);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    `;

    // Ajouter le bouton toggle pour mobile
    if (window.innerWidth <= 1200) {
        document.body.appendChild(sidebarToggle);
        sidebarToggle.style.display = 'flex';
    }

    // Toggle sidebar sur mobile
    sidebarToggle.addEventListener('click', () => {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('open');
    });

    // Fermer sidebar en cliquant à l'extérieur
    document.addEventListener('click', (e) => {
        const sidebar = document.querySelector('.sidebar');
        const isClickInsideSidebar = sidebar.contains(e.target);
        const isToggleButton = e.target === sidebarToggle || sidebarToggle.contains(e.target);
        
        if (!isClickInsideSidebar && !isToggleButton && sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
        }
    });

    // Animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observer les éléments animables
    const animatedElements = document.querySelectorAll('.stat-card, .course-progress-card, .achievement-badge, .certificate-mini');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Mise à jour de la progression globale (animation)
    const progressFill = document.querySelector('.progress-fill');
    if (progressFill) {
        const targetWidth = progressFill.style.width;
        progressFill.style.width = '0%';
        setTimeout(() => {
            progressFill.style.width = targetWidth;
        }, 500);
    }

    // Gestion du responsive pour le sidebar
    window.addEventListener('resize', () => {
        if (window.innerWidth <= 1200) {
            if (!document.body.contains(sidebarToggle)) {
                document.body.appendChild(sidebarToggle);
            }
            sidebarToggle.style.display = 'flex';
        } else {
            if (document.body.contains(sidebarToggle)) {
                sidebarToggle.style.display = 'none';
            }
            document.querySelector('.sidebar').classList.remove('open');
        }
    });

    // Animation hover pour les cartes de cours
    const courseCards = document.querySelectorAll('.course-progress-card');
    courseCards.forEach(card => {
        const img = card.querySelector('.course-image img');
        
        card.addEventListener('mouseenter', () => {
            if (img) {
                img.style.transform = 'scale(1.05)';
            }
        });
        
        card.addEventListener('mouseleave', () => {
            if (img) {
                img.style.transform = 'scale(1)';
            }
        });
    });

    // Notification toast pour les actions
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.style.cssText = `
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: ${type === 'success' ? 'var(--success-color)' : 'var(--danger-color)'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }

    // Gestion des clics sur les boutons d'action
    const actionButtons = document.querySelectorAll('.continue-btn, .download-mini, .cta-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            // Animation de clic
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = '';
            }, 150);
        });
    });

    // Actualisation automatique des données (simulation)
    setInterval(() => {
        // Simuler la mise à jour du temps d'étude d'aujourd'hui
        const todayTime = document.querySelector('.stat-item span');
        if (todayTime && todayTime.textContent.includes('h')) {
            // Incrémenter le temps (simulation)
            const currentTime = todayTime.textContent;
            // Logique de mise à jour ici si nécessaire
        }
    }, 60000); // Mise à jour chaque minute

    console.log('Dashboard étudiant initialisé avec succès!');
});
</script>
@endsection