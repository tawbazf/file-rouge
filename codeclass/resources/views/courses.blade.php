@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Our Courses</h1>
        
        <!-- Course filters -->
        <div class="mb-6 flex flex-wrap gap-2">
            <button class="filter-btn px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-sm font-medium" data-filter="all">All Materials</button>
            <button class="filter-btn px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm" data-filter="video">Videos Only</button>
            <button class="filter-btn px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm" data-filter="pdf">PDFs Only</button>
        </div>
        
        <div class="col-span-full py-8 bg-gray-50 rounded-lg">
            @if($courses->isEmpty())
                <p class="text-gray-500 text-lg text-center">No courses available yet.</p>
            @else
                <ul class="w-full space-y-8 px-6">
                @foreach($courses as $course)
                    <li class="course-item bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h2 class="text-2xl font-semibold text-gray-900">{{ $course->title }}</h2>
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                    {{ $course->level ?? 'All Levels' }}
                                </span>
                            </div>
                            <p class="text-gray-600 mt-2 mb-4">{{ $course->description }}</p>
                            
                            <!-- Course materials section -->
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Course Materials</h3>
                                
                                <!-- Videos -->
                                @if(isset($course->videos) && count($course->videos) > 0)
                                    <div class="mb-6 material-section" data-type="video">
                                        <h4 class="text-md font-medium text-gray-700 mb-2 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                <path d="M14 6a2 2 0 012-2h2a2 2 0 012 2v8a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z" />
                                            </svg>
                                            Videos ({{ count($course->videos) }})
                                        </h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                            @foreach($course->videos as $video)
                                                <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                                    <div class="aspect-w-16 aspect-h-9 mb-2">
                                                        <iframe 
                                                            src="{{ $video->url }}" 
                                                            class="w-full h-32 rounded" 
                                                            frameborder="0" 
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                            allowfullscreen>
                                                        </iframe>
                                                    </div>
                                                    <p class="text-sm font-medium">{{ $video->title }}</p>
                                                    <p class="text-xs text-gray-500">{{ $video->duration }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- PDFs -->
                                @if(isset($course->pdfs) && count($course->pdfs) > 0)
                                    <div class="mb-4 material-section" data-type="pdf">
                                        <h4 class="text-md font-medium text-gray-700 mb-2 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                            </svg>
                                            PDF Documents ({{ count($course->pdfs) }})
                                        </h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                            @foreach($course->pdfs as $pdf)
                                                <a href="{{ $pdf->url }}" target="_blank" class="flex items-center p-3 bg-gray-50 rounded border border-gray-200 hover:bg-gray-100 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm font-medium">{{ $pdf->title }}</p>
                                                        <p class="text-xs text-gray-500">{{ $pdf->pages }} pages • {{ $pdf->size }}</p>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- If no materials are available -->
                                @if((!isset($course->videos) || count($course->videos) == 0) && (!isset($course->pdfs) || count($course->pdfs) == 0))
                                    <p class="text-gray-500 italic">No materials available for this course yet.</p>
                                @endif
                            </div>
                            
                            <div class="mt-6 flex justify-between items-center">
                                <div class="flex items-center">
                                    <img src="{{ $course->instructor_avatar ?? 'https://ui-avatars.com/api/?name=Instructor' }}" alt="Instructor" class="h-8 w-8 rounded-full mr-2">
                                    <span class="text-sm text-gray-600">{{ $course->instructor ?? 'Instructor' }}</span>
                                </div>
                                <a href="/courses/{{ $course->id }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                                    View Course
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<script>
    // Add interactivity for the filter buttons
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Reset all buttons
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-100', 'text-blue-800');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                });
                
                // Highlight clicked button
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-blue-100', 'text-blue-800');
                
                // Filter logic
                const filter = this.getAttribute('data-filter');
                const courseItems = document.querySelectorAll('.course-item');
                
                courseItems.forEach(item => {
                    if (filter === 'all') {
                        item.style.display = 'block';
                    } else {
                        const hasFilteredContent = item.querySelector(`.material-section[data-type="${filter}"]`);
                        item.style.display = hasFilteredContent ? 'block' : 'none';
                    }
                });
            });
        });
    });
</script>
@endsection
