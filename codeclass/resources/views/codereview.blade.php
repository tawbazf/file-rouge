<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
        }
        .code-font {
            font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        }
        .tag-performance {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .tag-style {
            background-color: #d1fae5;
            color: #065f46;
        }
        .tag-functionality {
            background-color: #ede9fe;
            color: #5b21b6;
        }
        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            vertical-align: middle;
            margin-left: 8px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <!-- Header -->
        <header class="flex justify-between items-center mb-6 bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center">
                <h1 class="text-xl font-mono font-semibold text-gray-800 mr-4">Code Review Platform</h1>
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Teacher Mode</span>
            </div>
            <div class="flex items-center">
                <button class="mr-4 text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="h-8 w-8 rounded-full">
            </div>
        </header>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Code Panel -->
            <div class="bg-white rounded-lg shadow-sm p-6 flex-1">
                <!-- File Selector -->
                <div class="mb-4">
                    <form method="GET" action="{{ route('codereview') }}">
                        <select name="fileId" onchange="this.form.submit()" class="border rounded p-2">
                            @foreach($files as $file)
                                <option value="{{ $file->id }}" {{ $selectedFile && $selectedFile->id == $file->id ? 'selected' : '' }}>
                                    {{ $file->filename }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-mono text-gray-700">{{ $selectedFile->filename ?? '' }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <button class="flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download
                        </button>
                        <button class="flex items-center px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Comment
                        </button>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-md overflow-x-auto">
                    <pre class="code-font text-sm text-gray-800">{{ $selectedFile->content ?? '' }}</pre>
                    
                    <!-- Code Execution Section -->
                    <div class="mt-4">
                        <form id="run-code-form" class="mb-2">
                            @csrf
                            <input type="hidden" name="fileId" value="{{ $selectedFile->id ?? '' }}">
                            <input type="hidden" name="language_id" value="{{ $selectedFile->language_id ?? 71 }}"> <!-- Default to Python -->
                            <div class="flex items-center space-x-4">
                                <div>
                                    <label for="language" class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                                    <select id="language" name="language_id" class="border rounded p-2 text-sm">
                                        <option value="50">C</option>
                                        <option value="54">C++</option>
                                        <option value="62">Java</option>
                                        <option value="71" selected>Python</option>
                                        <option value="63">JavaScript</option>
                                        <option value="68">PHP</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label for="input" class="block text-sm font-medium text-gray-700 mb-1">Input (stdin)</label>
                                    <input type="text" id="input" name="input" class="border rounded p-2 w-full text-sm" placeholder="Enter input if needed">
                                </div>
                            </div>
                            <button type="submit" id="run-button" class="mt-3 px-4 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 flex items-center">
                                Run Code
                                <span id="loader" class="loader hidden"></span>
                            </button>
                        </form>
                        <div class="mt-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Output</label>
                            <div id="run-output" class="bg-gray-100 p-3 rounded text-sm text-gray-800 min-h-20 font-mono whitespace-pre-wrap"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Panel -->
            <div class="bg-white rounded-lg shadow-sm p-6 w-full md:w-96">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Filter Comments</h2>
                <!-- Filter Tabs -->
                <div class="flex flex-wrap gap-2 mb-6" id="commentFilterTabs">
                    <button class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-sm font-medium filter-btn" data-filter="all">All</button>
                    <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm filter-btn" data-filter="functionality">Functionality</button>
                    <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm filter-btn" data-filter="performance">Performance</button>
                    <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm filter-btn" data-filter="style">Style</button>
                </div>
                <!-- Comments List -->
                <div class="space-y-6">
                    @foreach($comments as $comment)
                        <div class="border-b border-gray-200 pb-4 comment-item" data-tag="{{ $comment->tag }}">
                            <div class="flex items-start mb-2">
                                <img src="{{ $comment->user->avatar ?? 'default-avatar.png' }}" alt="{{ $comment->user->name ?? 'User' }}" class="h-8 w-8 rounded-full mr-3">
                                <div class="flex-1">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="font-medium text-gray-900">{{ $comment->user->name ?? 'User' }}</span>
                                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <span class="tag-{{ $comment->tag }} text-xs px-2 py-1 rounded-full inline-block mb-2">{{ ucfirst($comment->tag) }}</span>
                                    <p class="text-sm text-gray-700">
                                        {{ $comment->text }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const comments = document.querySelectorAll('.comment-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove highlight from all buttons
                    filterBtns.forEach(b => b.classList.remove('bg-blue-100', 'text-blue-800'));
                    filterBtns.forEach(b => b.classList.add('bg-gray-100', 'text-gray-700'));
                    // Highlight the active button
                    btn.classList.remove('bg-gray-100', 'text-gray-700');
                    btn.classList.add('bg-blue-100', 'text-blue-800');

                    const filter = btn.getAttribute('data-filter');
                    comments.forEach(comment => {
                        if (filter === 'all' || comment.getAttribute('data-tag') === filter) {
                            comment.style.display = '';
                        } else {
                            comment.style.display = 'none';
                        }
                    });
                });
            });

            document.getElementById('run-code-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const runButton = document.getElementById('run-button');
                const loader = document.getElementById('loader');
                const outputDiv = document.getElementById('run-output');
                
                // Show loading state
                runButton.disabled = true;
                loader.classList.remove('hidden');
                outputDiv.innerText = 'Executing code...';
                
                const formData = new FormData(this);
                
                fetch('/execute-code', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        outputDiv.innerText = 'Error: ' + data.error;
                    } else {
                        outputDiv.innerText = data.output || 'No output';
                    }
                })
                .catch(err => {
                    outputDiv.innerText = 'Error: ' + err.message;
                })
                .finally(() => {
                    runButton.disabled = false;
                    loader.classList.add('hidden');
                });
            });
        });
    </script>
</body>
</html>