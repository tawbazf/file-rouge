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
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-mono text-gray-700">main.js</span>
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
                    <pre class="code-font text-sm text-gray-800">function calculateTotal(items) { let total = 0; for (let i = 0; i < items.length; i++) { total += items[i].price; } return total; }</pre>
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
                    <!-- Comment 1 -->
                    <div class="border-b border-gray-200 pb-4">
                        <div class="flex items-start mb-2">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Prof. Smith" class="h-8 w-8 rounded-full mr-3">
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-medium text-gray-900">Prof. Smith</span>
                                    <span class="text-xs text-gray-500">2 hours ago</span>
                                </div>
                                <span class="tag-performance text-xs px-2 py-1 rounded-full inline-block mb-2">Performance</span>
                                <p class="text-sm text-gray-700">
                                    Consider using reduce() method instead of for loop for better performance and readability.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Comment 2 -->
                    <div class="border-b border-gray-200 pb-4">
                        <div class="flex items-start mb-2">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Alice Cooper" class="h-8 w-8 rounded-full mr-3">
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-medium text-gray-900">Alice Cooper</span>
                                    <span class="text-xs text-gray-500">5 hours ago</span>
                                </div>
                                <span class="tag-style text-xs px-2 py-1 rounded-full inline-block mb-2">Style</span>
                                <p class="text-sm text-gray-700">
                                    The variable naming is clear and follows the conventions. Good job!
                                </p>
                            </div>
                        </div>
                    </div>
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
});
</script>
</body>
</html>