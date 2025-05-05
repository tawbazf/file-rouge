
<div class="py-12"> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <h1 class="text-3xl font-bold text-gray-900 mb-8">Our Courses</h1>
        <!-- Course filters -->
        <div class="mb-8 flex flex-wrap gap-3">
            <button class="filter-btn px-4 py-2 bg-blue-100 text-blue-800 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-blue-200 active:bg-blue-300" data-filter="all">All Materials</button>
            <button class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-200 active:bg-gray-300" data-filter="video">Videos Only</button>
            <button class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-200 active:bg-gray-300" data-filter="pdf">PDFs Only</button>
        </div>
        
        <div class="bg-gray-50 rounded-xl p-8">
            @if($courses->isEmpty())
                <p class="text-gray-500 text-lg text-center py-12">No courses available yet.</p>
            @else
                <ul class="space-y-6">
                    @foreach($courses as $course)
                        <li class="course-item bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h2 class="text-xl font-semibold text-gray-900">{{ $course->title }}</h2>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                        {{ $course->level ?? 'All Levels' }}
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-6 line-clamp-3">{{ $course->description }}</p>
                                
                                <!-- Course materials section -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Course Materials</h3>
                                    
                                    <!-- Videos -->
                                    @if(isset($course->videos) && count($course->videos) > 0)
                                        <div class="mb-6 material-section" data-type="video">
                                            <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                                                <svg class="h-5 w-5 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                    <path d="M14 6a2 2 0 012-2h2a2 2 0 012 2v8a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z" />
                                                </svg>
                                                Videos ({{ count($course->videos) }})
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                                @foreach($course->videos as $video)
                                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-gray-300 transition-colors duration-200">
                                                        <div class="aspect-w-16 aspect-h-9 mb-3">
                                                            <iframe 
                                                                src="{{ $video->url }}" 
                                                                class="w-full h-40 rounded-md" 
                                                                frameborder="0" 
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                                allowfullscreen
                                                                loading="lazy">
                                                            </iframe>
                                                        </div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $video->title }}</p>
                                                        <p class="text-xs text-gray-500">{{ $video->duration }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- PDFs -->
                                    @if(isset($course->pdfs) && count($course->pdfs) > 0)
                                        <div class="material-section" data-type="pdf">
                                            <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                                                <svg class="h-5 w-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                </svg>
                                                PDF Documents ({{ count($course->pdfs) }})
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                                @foreach($course->pdfs as $pdf)
                                                    <a href="{{ $pdf->url }}" target="_blank" class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors duration-200 group">
                                                        <svg class="h-8 w-8 text-red-600 mr-3 group-hover:text-red-700 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                        </svg>
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-900 group-hover:text-gray-900">{{ $pdf->title }}</p>
                                                            <p class="text-xs text-gray-500">{{ $pdf->pages }} pages • {{ $pdf->size }}</p>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if((!isset($course->videos) || count($course->videos) == 0) && (!isset($course->pdfs) || count($course->pdfs) == 0))
                                        <p class="text-gray-500 italic text-sm">No materials available for this course yet.</p>
                                    @endif
                                </div>
                                
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <div class="flex items-center">
                                        <img src="{{ $course->instructor_avatar ?? 'https://ui-avatars.com/api/?name=Instructor' }}" alt="Instructor" class="h-10 w-10 rounded-full mr-3">
                                        <span class="text-sm text-gray-600">{{ $course->instructor ?? 'Instructor' }}</span>
                                    </div>
                                    <a href="/courses/{{ $course->id }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
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
    document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const courseItems = document.querySelectorAll('.course-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.dataset.filter;

            filterButtons.forEach(btn => {
                btn.classList.toggle('bg-blue-100', btn === button);
                btn.classList.toggle('text-blue-800', btn === button);
                btn.classList.toggle('bg-gray-100', btn !== button);
                btn.classList.toggle('text-gray-700', btn !== button);
            });

            courseItems.forEach(item => {
                const materials = item.querySelectorAll('.material-section');
                if (filter === 'all') {
                    item.style.display = '';
                    return;
                }

                let match = false;
                materials.forEach(section => {
                    if (section.dataset.type === filter) {
                        match = true;
                    }
                });

                item.style.display = match ? '' : 'none';
            });
        });
    });
});

    
    </script>
    
    <style>
    .animate-in {
        animation: fadeIn 0.3s ease-in;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hidden {
        display: none;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
    