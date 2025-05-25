@extends('layouts.teacher')

@section('content')
<div class="teacher-dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="teacher-profile">
                <div class="teacher-avatar">
                    <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=4361ee&color=fff' }}" alt="Avatar">
                </div>
                <div class="teacher-info">
                    <h3>{{ auth()->user()->name }}</h3>
                    <span class="teacher-role">Enseignant</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item active">
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.courses.index') }}" class="nav-link">
                        <i class="fas fa-book-open"></i>
                        <span>Mes Cours</span>
                        <span class="nav-badge">{{ $stats['total_courses'] }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.students.index') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Étudiants</span>
                        <span class="nav-badge">{{ $stats['total_students'] }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.assignments.index') }}" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        <span>Devoirs</span>
                        <span class="nav-badge pending">{{ $stats['pending_assignments'] ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.quizzes.index') }}" class="nav-link">
                        <i class="fas fa-question-circle"></i>
                        <span>Quiz</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.discussions.index') }}" class="nav-link">
                        <i class="fas fa-comments"></i>
                        <span>Discussions</span>
                        <span class="nav-badge new">{{ $stats['unread_messages'] ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.analytics') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytiques</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.calendar') }}" class="nav-link">
                        <i class="fas fa-calendar"></i>
                        <span>Calendrier</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.resources.index') }}" class="nav-link">
                        <i class="fas fa-folder"></i>
                        <span>Ressources</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.certificates.index') }}" class="nav-link">
                        <i class="fas fa-certificate"></i>
                        <span>Certificats</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="nav-divider"></div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{ route('teacher.settings') }}" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <span>Paramètres</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.support') }}" class="nav-link">
                            <i class="fas fa-life-ring"></i>
                            <span>Support</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="top-bar-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">Tableau de bord</h1>
            </div>
            <div class="top-bar-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="notifications">
                    <button class="notification-btn" data-count="{{ $stats['notifications_count'] ?? 3 }}">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
                <div class="quick-actions">
                    <button class="quick-action-btn" onclick="openQuickCourseModal()">
                        <i class="fas fa-plus"></i>
                        <span>Créer</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="welcome-text">
                    <h2>Bonjour, {{ auth()->user()->name }}! 👋</h2>
                    <p>Voici un aperçu de votre activité d'enseignement aujourd'hui</p>
                </div>
                <div class="welcome-actions">
                    <a href="{{ route('teacher.courses.create') }}" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Nouveau cours
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card primary">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12%</span>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $stats['total_courses'] }}</h3>
                        <p class="stat-label">Cours créés</p>
                        <div class="stat-details">
                            <span>{{ $stats['active_courses'] ?? 0 }} actifs</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i>
                            <span>+8%</span>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $stats['total_students'] }}</h3>
                        <p class="stat-label">Étudiants inscrits</p>
                        <div class="stat-details">
                            <span>{{ $stats['new_students_month'] ?? 0 }} ce mois</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card warning">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-trend down">
                            <i class="fas fa-arrow-down"></i>
                            <span>-3%</span>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $stats['avg_completion_rate'] ?? '87' }}%</h3>
                        <p class="stat-label">Taux de completion</p>
                        <div class="stat-details">
                            <span>Moyenne cours</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card info">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-euro-sign"></i>
                        </div>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i>
                            <span>+25%</span>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ number_format($stats['total_revenue'] ?? 1250, 0, ',', ' ') }}€</h3>
                        <p class="stat-label">Revenus totaux</p>
                        <div class="stat-details">
                            <span>{{ $stats['revenue_month'] ?? 320 }}€ ce mois</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Recent Courses -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3><i class="fas fa-book"></i> Cours récents</h3>
                        <a href="{{ route('teacher.courses.index') }}" class="view-all">Voir tout</a>
                    </div>
                    <div class="card-content">
                        @foreach($courses->take(4) as $course)
                        <div class="course-item">
                            <div class="course-thumbnail">
                                <img src="{{ $course->image_url ?? 'https://source.unsplash.com/100x60?education&sig='.$loop->index }}" alt="{{ $course->title }}">
                                <span class="course-badge {{ $course->is_free ? 'free' : 'premium' }}">
                                    {{ $course->is_free ? 'Gratuit' : 'Payant' }}
                                </span>
                            </div>
                            <div class="course-info">
                                <h4>{{ Str::limit($course->title, 30) }}</h4>
                                <div class="course-meta">
                                    <span><i class="fas fa-users"></i> {{ $course->students_count }}</span>
                                    <span><i class="fas fa-star"></i> {{ $course->average_rating ?? '4.5' }}</span>
                                </div>
                                <div class="course-progress">
                                    <div class="progress-bar" style="width: {{ rand(60, 95) }}%"></div>
                                </div>
                            </div>
                            <div class="course-actions">
                                <a href="{{ route('teacher.courses.show', $course) }}" class="btn-icon">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('teacher.courses.edit', $course) }}" class="btn-icon">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3><i class="fas fa-clock"></i> Activité récente</h3>
                    </div>
                    <div class="card-content">
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon success">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Marie Dubois</strong> s'est inscrite à <em>JavaScript Avancé</em></p>
                                    <span class="activity-time">Il y a 2 heures</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon info">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="activity-content">
                                    <p>Nouveau message dans <em>Forum HTML/CSS</em></p>
                                    <span class="activity-time">Il y a 4 heures</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon warning">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Pierre Martin</strong> a soumis un devoir</p>
                                    <span class="activity-time">Il y a 6 heures</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon primary">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="activity-content">
                                    <p>Nouvelle évaluation 5⭐ pour <em>React Fundamentals</em></p>
                                    <span class="activity-time">Hier</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3><i class="fas fa-bolt"></i> Actions rapides</h3>
                    </div>
                    <div class="card-content">
                        <div class="quick-actions-grid">
                            <a href="{{ route('teacher.courses.create') }}" class="quick-action-item">
                                <div class="quick-action-icon primary">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span>Créer un cours</span>
                            </a>
                            <a href="{{ route('teacher.assignments.create') }}" class="quick-action-item">
                                <div class="quick-action-icon warning">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <span>Nouveau devoir</span>
                            </a>
                            <a href="{{ route('teacher.quizzes.create') }}" class="quick-action-item">
                                <div class="quick-action-icon success">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <span>Créer un quiz</span>
                            </a>
                            <a href="{{ route('teacher.announcements.create') }}" class="quick-action-item">
                                <div class="quick-action-icon info">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <span>Annonce</span>
                            </a>
                            <a href="{{ route('teacher.resources.upload') }}" class="quick-action-item">
                                <div class="quick-action-icon secondary">
                                    <i class="fas fa-upload"></i>
                                </div>
                                <span>Upload fichier</span>
                            </a>
                            <a href="{{ route('teacher.analytics') }}" class="quick-action-item">
                                <div class="quick-action-icon dark">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <span>Voir stats</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Performance Chart -->
                <div class="dashboard-card chart-card">
                    <div class="card-header">
                        <h3><i class="fas fa-chart-line"></i> Performance des cours</h3>
                        <div class="chart-controls">
                            <select id="chartPeriod">
                                <option value="7">7 derniers jours</option>
                                <option value="30" selected>30 derniers jours</option>
                                <option value="90">3 derniers mois</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-content">
                        <canvas id="performanceChart" height="300"></canvas>
                    </div>
                </div>

                <!-- Pending Tasks -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3><i class="fas fa-exclamation-circle"></i> Tâches en attente</h3>
                        <span class="header-badge">{{ $stats['pending_tasks'] ?? 5 }}</span>
                    </div>
                    <div class="card-content">
                        <div class="task-list">
                            <div class="task-item urgent">
                                <div class="task-priority"></div>
                                <div class="task-content">
                                    <h4>Corriger les devoirs - JavaScript</h4>
                                    <p>8 devoirs en attente de correction</p>
                                    <span class="task-due">Due dans 2 jours</span>
                                </div>
                                <a href="{{ route('teacher.assignments.pending') }}" class="task-action">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="task-item medium">
                                <div class="task-priority"></div>
                                <div class="task-content">
                                    <h4>Répondre aux questions forum</h4>
                                    <p>12 nouvelles questions</p>
                                    <span class="task-due">Due dans 1 jour</span>
                                </div>
                                <a href="{{ route('teacher.discussions.unanswered') }}" class="task-action">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="task-item low">
                                <div class="task-priority"></div>
                                <div class="task-content">
                                    <h4>Mettre à jour le cours React</h4>
                                    <p>Ajouter nouveau contenu</p>
                                    <span class="task-due">Due dans 1 semaine</span>
                                </div>
                                <a href="{{ route('teacher.courses.edit', 1) }}" class="task-action">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Students -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3><i class="fas fa-trophy"></i> Meilleurs étudiants</h3>
                    </div>
                    <div class="card-content">
                        <div class="student-list">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="student-item">
                                <div class="student-rank">#{{ $i }}</div>
                                <div class="student-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Student{{ $i }}&background=random" alt="Student">
                                </div>
                                <div class="student-info">
                                    <h4>Étudiant {{ $i }}</h4>
                                    <p>{{ rand(85, 98) }}% de réussite</p>
                                </div>
                                <div class="student-score">
                                    <span class="score">{{ rand(450, 500) }}pts</span>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
:root {
    --primary-color: #4361ee;
    --primary-light: #e0e7ff;
    --secondary-color: #3f37c9;
    --success-color: #10b981;
    --success-light: #d1fae5;
    --info-color: #3b82f6;
    --info-light: #dbeafe;
    --warning-color: #f59e0b;
    --warning-light: #fef3c7;
    --danger-color: #ef4444;
    --danger-light: #fee2e2;
    --dark-color: #1e293b;
    --light-color: #f8fafc;
    --gray-color: #94a3b8;
    --border-color: #e2e8f0;
    --sidebar-width: 280px;
    --topbar-height: 70px;
}

/* Layout */
.teacher-dashboard-container {
    display: flex;
    min-height: 100vh;
    background-color: var(--light-color);
}

/* Sidebar */
.sidebar {
    width: var(--sidebar-width);
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    transition: transform 0.3s ease;
    z-index: 100;
}

.sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.teacher-profile {
    display: flex;
    align-items: center;
}

.teacher-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 1rem;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.teacher-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.teacher-info h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.teacher-role {
    font-size: 0.85rem;
    opacity: 0.8;
}

/* Navigation */
.sidebar-nav {
    padding: 1rem 0;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-item {
    margin-bottom: 0.25rem;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.2s ease;
    position: relative;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
}

.nav-item.active .nav-link {
    background-color: rgba(255, 255, 255, 0.15);
    color: white;
}

.nav-item.active .nav-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background-color: white;
}

.nav-link i {
    width: 20px;
    margin-right: 1rem;
    text-align: center;
}

.nav-link span {
    flex: 1;
}

.nav-badge {
    background-color: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.2rem 0.5rem;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
}

.nav-badge.pending {
    background-color: var(--warning-color);
}

.nav-badge.new {
    background-color: var(--danger-color);
}

.sidebar-footer {
    margin-top: auto;
    padding-top: 1rem;
}

.nav-divider {
    height: 1px;
    background-color: rgba(255, 255, 255, 0.1);
    margin: 1rem 1.5rem;
}

.logout-btn {
    color: rgba(255, 255, 255, 0.6);
}

.logout-btn:hover {
    color: var(--danger-color);
}

/* Main Content */
.main-content {
    flex: 1;
    margin-left: var(--sidebar-width);
    display: flex;
    flex-direction: column;
}

/* Top Bar */
.top-bar {
    height: var(--topbar-height);
    background: white;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    position: sticky;
    top: 0;
    z-index: 50;
}

.top-bar-left {
    display: flex;
    align-items: center;
}

.sidebar-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--gray-color);
    margin-right: 1rem;
    cursor: pointer;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--dark-color);
    margin: 0;
}

.top-bar-right {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.search-box i {
    position: absolute;
    left: 1rem;
    color: var(--gray-color);
}

.search-box input {
    padding: 0.5rem 1rem 0.5rem 2.5rem;
    border: 1px solid var(--border-color);
    border-radius: 25px;
    background-color: var(--light-color);
    width: 250px;
    font-size: 0.9rem;
}

.notification-btn {
    position: relative;
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--gray-color);
    cursor: pointer;
    padding: 0.5rem;
}

.notification-btn::after {
    content: attr(data-count);
    position: absolute;
    top: 0;
    right: 0;
    background-color: var(--danger-color);
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quick-action-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quick-action-btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-1px);
}

/* Dashboard Content */
.dashboard-content {
    flex: 1;
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
}

/* Welcome Section */
.welcome-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.welcome-text h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.welcome-text p {
    color: var(--gray-color);
    font-size: 1rem;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
}

.stat-card.primary::before {
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
}

.stat-card.success::before {
    background: linear-gradient(90deg, var(--success-color), #059669);
}

.stat-card.warning::before {
    background: linear-gradient(90deg, var(--warning-color), #d97706);
}

.stat-card.info::before {
    background: linear-gradient(90deg, var(--info-color), #2563eb);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.stat-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.stat-card.primary .stat-icon {
    background-color: var(--primary-light);
    color: var(--primary-color);
}

.stat-card.success .stat-icon {
    background-color: var(--success-light);
    color: var(--success-color);
}

.stat-card.warning .stat-icon {
    background-color: var(--warning-light);
    color: var(--warning-color);
}

.stat-card.info .stat-icon {
    background-color: var(--info-light);
    color: var(--info-color);
}

.stat-trend {
    display: flex;
    align-items: center;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
}

.stat-trend.up {
    background-color: var(--success-light);
    color: var(--success-color);
}

.stat-trend.down {
    background-color: var(--danger-light);
    color: var(--danger-color);
}

.stat-trend i {
    margin-right: 0.25rem;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--gray-color);
    margin-bottom: 0.5rem;
}

.stat-details {
    font-size: 0.8rem;
    color: var(--gray-color);
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 1.5rem;
}

.dashboard-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease;
}

.dashboard-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dashboard-card:nth-child(1) { grid-column: span 6; } /* Recent Courses */
.dashboard-card:nth-child(2) { grid-column: span 6; } /* Recent Activity */
.dashboard-card:nth-child(3) { grid-column: span 4; } /* Quick Actions */
.dashboard-card:nth-child(4) { grid-column: span 8; } /* Performance Chart */
.dashboard-card:nth-child(5) { grid-column: span 4; } /* Pending Tasks */
.dashboard-card:nth-child(6) { grid-column: span 4; } /* Top Students */

.card-header {
    padding: 1.5rem 1.5rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.card-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark-color);
    display: flex;
    align-items: center;
}

.card-header h3 i {
    margin-right: 0.5rem;
    color: var(--primary-color);
}

.view-all {
    color: var(--primary-color);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
}

.view-all:hover {
    text-decoration: underline;
}

.header-badge {
    background-color: var(--danger-color);
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.card-content {
    padding: 0 1.5rem 1.5rem;
}

/* Course Items */
.course-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
}

.course-item:last-child {
    border-bottom: none;
}

.course-thumbnail {
    position: relative;
    margin-right: 1rem;
}

.course-thumbnail img {
    width: 60px;
    height: 40px;
    border-radius: 6px;
    object-fit: cover;
}

.course-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    padding: 0.1rem 0.4rem;
    border-radius: 8px;
    font-size: 0.6rem;
    font-weight: 600;
}

.course-badge.free {
    background-color: var(--success-color);
    color: white;
}

.course-badge.premium {
    background-color: var(--warning-color);
    color: white;
}

.course-info {
    flex: 1;
}

.course-info h4 {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: var(--dark-color);
}

.course-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.8rem;
    color: var(--gray-color);
    margin-bottom: 0.5rem;
}

.course-meta span {
    display: flex;
    align-items: center;
}

.course-meta i {
    margin-right: 0.25rem;
    color: var(--primary-color);
}

.course-progress {
    height: 4px;
    background-color: var(--border-color);
    border-radius: 2px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background-color: var(--primary-color);
    border-radius: 2px;
    transition: width 0.3s ease;
}

.course-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--light-color);
    color: var(--gray-color);
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-icon:hover {
    background-color: var(--primary-color);
    color: white;
    transform: translateY(-1px);
}

/* Activity List */
.activity-list {
    max-height: 300px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.activity-icon.success {
    background-color: var(--success-light);
    color: var(--success-color);
}

.activity-icon.info {
    background-color: var(--info-light);
    color: var(--info-color);
}

.activity-icon.warning {
    background-color: var(--warning-light);
    color: var(--warning-color);
}

.activity-icon.primary {
    background-color: var(--primary-light);
    color: var(--primary-color);
}

.activity-content p {
    font-size: 0.9rem;
    color: var(--dark-color);
    margin-bottom: 0.25rem;
}

.activity-time {
    font-size: 0.8rem;
    color: var(--gray-color);
}

/* Quick Actions Grid */
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.quick-action-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    text-decoration: none;
    color: var(--dark-color);
    transition: all 0.2s ease;
}

.quick-action-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.quick-action-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.quick-action-icon.primary {
    background-color: var(--primary-light);
    color: var(--primary-color);
}

.quick-action-icon.warning {
    background-color: var(--warning-light);
    color: var(--warning-color);
}

.quick-action-icon.success {
    background-color: var(--success-light);
    color: var(--success-color);
}

.quick-action-icon.info {
    background-color: var(--info-light);
    color: var(--info-color);
}

.quick-action-icon.secondary {
    background-color: #e2e8f0;
    color: #64748b;
}

.quick-action-icon.dark {
    background-color: #f1f5f9;
    color: var(--dark-color);
}

.quick-action-item span {
    font-size: 0.85rem;
    font-weight: 500;
    text-align: center;
}

/* Chart Card */
.chart-card .card-content {
    padding: 1rem 1.5rem 1.5rem;
}

.chart-controls select {
    padding: 0.5rem;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    background-color: white;
    font-size: 0.9rem;
}

/* Task List */
.task-list {
    max-height: 350px;
    overflow-y: auto;
}

.task-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
    position: relative;
}

.task-item:last-child {
    border-bottom: none;
}

.task-priority {
    width: 4px;
    height: 100%;
    position: absolute;
    left: -1.5rem;
    top: 0;
}

.task-item.urgent .task-priority {
    background-color: var(--danger-color);
}

.task-item.medium .task-priority {
    background-color: var(--warning-color);
}

.task-item.low .task-priority {
    background-color: var(--success-color);
}

.task-content {
    flex: 1;
    margin-right: 1rem;
}

.task-content h4 {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: var(--dark-color);
}

.task-content p {
    font-size: 0.85rem;
    color: var(--gray-color);
    margin-bottom: 0.25rem;
}

.task-due {
    font-size: 0.8rem;
    color: var(--warning-color);
    font-weight: 500;
}

.task-action {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--light-color);
    color: var(--gray-color);
    text-decoration: none;
    transition: all 0.2s ease;
}

.task-action:hover {
    background-color: var(--primary-color);
    color: white;
}

/* Student List */
.student-list {
    max-height: 350px;
    overflow-y: auto;
}

.student-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
}

.student-item:last-child {
    border-bottom: none;
}

.student-rank {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--primary-light);
    color: var(--primary-color);
    font-weight: 600;
    font-size: 0.85rem;
    margin-right: 1rem;
}

.student-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 1rem;
}

.student-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.student-info {
    flex: 1;
}

.student-info h4 {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: var(--dark-color);
}

.student-info p {
    font-size: 0.8rem;
    color: var(--gray-color);
}

.student-score {
    text-align: right;
}

.score {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--primary-color);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .dashboard-grid > *:nth-child(1) { grid-column: span 12; }
    .dashboard-grid > *:nth-child(2) { grid-column: span 12; }
    .dashboard-grid > *:nth-child(3) { grid-column: span 6; }
    .dashboard-grid > *:nth-child(4) { grid-column: span 12; }
    .dashboard-grid > *:nth-child(5) { grid-column: span 6; }
    .dashboard-grid > *:nth-child(6) { grid-column: span 6; }
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }
    
    .sidebar.active {
        transform: translateX(0);
    }
    
    .main-content {
        margin-left: 0;
    }
    
    .sidebar-toggle {
        display: block;
    }
    
    .dashboard-content {
        padding: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .dashboard-grid > * {
        grid-column: span 12 !important;
    }
    
    .welcome-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .top-bar {
        padding: 0 1rem;
    }
    
    .search-box {
        display: none;
    }
    
    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .top-bar-right {
        gap: 0.5rem;
    }
    
    .quick-action-btn span {
        display: none;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dashboard-card,
.stat-card {
    animation: fadeInUp 0.6s ease-out;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        }
    });
    
    // Performance Chart
    const ctx = document.getElementById('performanceChart');
    if (ctx) {
        const performanceChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($months ?? ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun']) !!},
                datasets: [
                    {
                        label: 'Étudiants inscrits',
                        data: {!! json_encode($studentCounts ?? [12, 19, 15, 25, 32, 28]) !!},
                        borderColor: 'rgba(67, 97, 238, 1)',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(67, 97, 238, 1)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    },
                    {
                        label: 'Cours créés',
                        data: {!! json_encode($courseCounts ?? [5, 8, 6, 12, 15, 11]) !!},
                        borderColor: 'rgba(16, 185, 129, 1)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    },
                    {
                        label: 'Revenus (x100€)',
                        data: {!! json_encode($revenueData ?? [8, 12, 10, 18, 22, 25]) !!},
                        borderColor: 'rgba(245, 158, 11, 1)',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(245, 158, 11, 1)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            precision: 0,
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
        
        // Chart period change
        const chartPeriod = document.getElementById('chartPeriod');
        if (chartPeriod) {
            chartPeriod.addEventListener('change', function() {
                // Ici vous pouvez ajouter la logique pour changer les données du graphique
                console.log('Période changée:', this.value);
            });
        }
    }
    
    // Notification animations
    const notificationBtn = document.querySelector('.notification-btn');
    if (notificationBtn) {
        notificationBtn.addEventListener('click', function() {
            // Animation du bouton de notification
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }
    
    // Quick Action Modal (placeholder function)
    window.openQuickCourseModal = function() {
        // Ici vous pouvez ouvrir un modal pour créer rapidement un cours
        console.log('Ouverture du modal de création rapide');
    };
    
    // Smooth scrolling for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Progress bar animations
    const progressBars = document.querySelectorAll('.progress-bar');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const progressObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const width = progressBar.style.width;
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.width = width;
                }, 100);
            }
        });
    }, observerOptions);
    
    progressBars.forEach(bar => {
        progressObserver.observe(bar);
    });
    
    // Auto-refresh stats every 5 minutes (optional)
    setInterval(function() {
        // Ici vous pouvez ajouter une requête AJAX pour rafraîchir les stats
        console.log('Rafraîchissement automatique des statistiques');
    }, 300000); // 5 minutes
});
</script>

<!-- Chart.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

@endsection