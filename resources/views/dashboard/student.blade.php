<!-- In Progress Courses -->
<div class="mb-8">
    <h2 class="text-lg font-medium text-gray-900 mb-4">In Progress Courses</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($inProgressCourses as $enrollment)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative pb-[56.25%]">
                    <img src="{{ $enrollment->course->thumbnail ? Storage::url($enrollment->course->thumbnail) : asset('images/default-course.jpg') }}" 
                         alt="{{ $enrollment->course->title }}" 
                         class="absolute h-full w-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        <a href="{{ route('courses.show', $enrollment->course) }}" class="hover:text-indigo-600">
                            {{ $enrollment->course->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500 mb-4">
                        By {{ $enrollment->course->teacher->name }}
                    </p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Progress</span>
                            <span>{{ $enrollment->progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $enrollment->progress }}%"></div>
                        </div>
                    </div>
                    <a href="{{ route('courses.show', $enrollment->course) }}" 
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Continue Learning
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500">You haven't started any courses yet.</p>
                    <a href="{{ route('courses.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 mt-4">
                        Browse Courses
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Completed Courses -->
@if($completedCourses->isNotEmpty())
    <div class="mb-8">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Completed Courses</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($completedCourses as $enrollment)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative pb-[56.25%]">
                        <img src="{{ $enrollment->course->thumbnail ? Storage::url($enrollment->course->thumbnail) : asset('images/default-course.jpg') }}" 
                             alt="{{ $enrollment->course->title }}" 
                             class="absolute h-full w-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-25 flex items-center justify-center">
                            <div class="bg-white rounded-full p-3">
                                <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            {{ $enrollment->course->title }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-4">
                            By {{ $enrollment->course->teacher->name }}
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Completed
                            </span>
                            @if($certificates->contains('course_id', $enrollment->course_id))
                                <a href="{{ route('certificates.download', $certificates->where('course_id', $enrollment->course_id)->first()) }}" 
                                   class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-900">
                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    View Certificate
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<!-- Recent Activity and Recommendations -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Activity -->
    <div class="lg:col-span-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @forelse($recentLessons as $completion)
                            <li>
                                <div class="relative pb-8">
                                    @if(!$loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500">Completed <span class="font-medium text-gray-900">{{ $completion->lesson->title }}</span> in <a href="{{ route('courses.show', $completion->lesson->course) }}" class="font-medium text-indigo-600 hover:text-indigo-900">{{ $completion->lesson->course->title }}</a></p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time datetime="{{ $completion->completed_at }}">{{ $completion->completed_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="text-center text-gray-500 py-4">
                                No recent activity
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommended Courses -->
    <div class="lg:col-span-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recommended Courses</h3>
                <div class="space-y-6">
                    @foreach($recommendedCourses as $course)
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-16 w-16 rounded-lg object-cover" 
                                     src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : asset('images/default-course.jpg') }}" 
                                     alt="">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $course->title }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    By {{ $course->teacher->name }}
                                </p>
                                <div class="flex items-center mt-1">
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="h-4 w-4 {{ $i <= ($course->ratings_avg_rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                 fill="currentColor" 
                                                 viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">({{ $course->enrollments_count }} enrolled)</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ route('courses.show', $course) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div> 