@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200 mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Mes Devoirs</h1>
                        <p class="text-sm text-gray-600">Gérez vos travaux à rendre</p>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="hidden md:flex items-center space-x-8">
                    <div class="text-center">
                        <div class="text-xl font-semibold text-orange-600">{{ $assignments->where('status', 'pending')->count() }}</div>
                        <div class="text-xs text-gray-500">En attente</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-semibold text-green-600">{{ $assignments->where('status', 'completed')->count() }}</div>
                        <div class="text-xs text-gray-500">Terminés</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-semibold text-red-600">{{ $assignments->where('due_date', '<', now())->where('status', '!=', 'completed')->count() }}</div>
                        <div class="text-xs text-gray-500">En retard</div>
                    </div>
                </div>
            </div>
            
            <!-- Filter Tabs -->
            <div class="mt-6">
                <div class="flex space-x-1">
                    <button class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md">
                        Tous ({{ $assignments->count() }})
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 border border-transparent rounded-md">
                        En cours ({{ $assignments->where('status', 'pending')->count() }})
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 border border-transparent rounded-md">
                        Terminés ({{ $assignments->where('status', 'completed')->count() }})
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 border border-transparent rounded-md">
                        En retard ({{ $assignments->where('due_date', '<', now())->where('status', '!=', 'completed')->count() }})
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($assignments->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="text-center py-12 px-6">
                    <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun devoir assigné</h3>
                    <p class="text-gray-500 mb-6 max-w-sm mx-auto">
                        Vous n'avez actuellement aucun devoir à faire. Profitez-en pour réviser vos cours !
                    </p>
                    
                    <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Voir mes cours
                    </button>
                </div>
            </div>
        @else
            <!-- Assignments List -->
            <div class="space-y-4">
                @foreach($assignments as $assignment)
                    @php
                        $isOverdue = $assignment->due_date < now() && $assignment->status !== 'completed';
                        $isDueSoon = $assignment->due_date > now() && $assignment->due_date <= now()->addDays(2) && $assignment->status !== 'completed';
                        $isCompleted = $assignment->status === 'completed';
                    @endphp
                    
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200 
                        @if($isOverdue) border-l-4 border-l-red-500 @elseif($isDueSoon) border-l-4 border-l-yellow-500 @elseif($isCompleted) border-l-4 border-l-green-500 @endif">
                        
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <!-- Assignment Info -->
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $assignment->title }}
                                        </h3>
                                        
                                        @if($isCompleted)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Terminé
                                            </span>
                                        @elseif($isOverdue)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                En retard
                                            </span>
                                        @elseif($isDueSoon)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Urgent
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                En cours
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center space-x-4 text-sm text-gray-600 mb-3">
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                            <span>{{ $assignment->course->title ?? 'Cours général' }}</span>
                                        </div>
                                        
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>{{ $assignment->instructor ?? 'Instructeur' }}</span>
                                        </div>
                                    </div>
                                    
                                    @if($assignment->description)
                                        <p class="text-gray-600 text-sm mb-4">
                                            {{ Str::limit($assignment->description, 120) }}
                                        </p>
                                    @endif
                                </div>
                                
                                <!-- Due Date -->
                                <div class="ml-6 text-right">
                                    <div class="bg-gray-50 rounded-lg p-3 min-w-[100px]">
                                        <div class="text-xs text-gray-500 mb-1">À rendre le</div>
                                        <div class="font-semibold text-gray-900 text-sm">
                                            {{ $assignment->due_date->format('d/m/Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $assignment->due_date->format('H:i') }}
                                        </div>
                                        
                                        @if($assignment->due_date > now())
                                            <div class="text-xs text-blue-600 mt-1 font-medium">
                                                Dans {{ $assignment->due_date->diffForHumans(null, true) }}
                                            </div>
                                        @elseif($assignment->status !== 'completed')
                                            <div class="text-xs text-red-600 mt-1 font-medium">
                                                {{ $assignment->due_date->diffForHumans() }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Assignment Details -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                                    </svg>
                                    <div>
                                        <div class="text-xs text-gray-500">Type</div>
                                        <div class="font-medium text-gray-700 text-sm">{{ ucfirst($assignment->type ?? 'Devoir') }}</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <div class="text-xs text-gray-500">Durée</div>
                                        <div class="font-medium text-gray-700 text-sm">{{ $assignment->estimated_hours ?? '2' }}h</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    <div>
                                        <div class="text-xs text-gray-500">Points</div>
                                        <div class="font-medium text-gray-700 text-sm">{{ $assignment->points ?? '100' }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    @if(!$isCompleted)
                                        <a href="{{ route('student.assignments.show', $assignment->id) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Commencer
                                        </a>
                                    @else
                                        <a href="{{ route('student.assignments.show', $assignment->id) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Voir résultat
                                        </a>
                                    @endif
                                    
                                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-md">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Progress -->
                                @if(!$isCompleted)
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                                        <div class="w-20 bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $assignment->progress ?? 0 }}%"></div>
                                        </div>
                                        <span class="text-xs">{{ $assignment->progress ?? 0 }}%</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Summary Stats -->
            <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Résumé</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">{{ $assignments->count() }}</div>
                            <div class="text-sm text-gray-500">Total devoirs</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $assignments->where('status', 'pending')->count() }}</div>
                            <div class="text-sm text-gray-500">En cours</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $assignments->where('status', 'completed')->count() }}</div>
                            <div class="text-sm text-gray-500">Terminés</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-600">{{ $assignments->count() > 0 ? round($assignments->where('status', 'completed')->count() / $assignments->count() * 100) : 0 }}%</div>
                            <div class="text-sm text-gray-500">Taux de réussite</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection