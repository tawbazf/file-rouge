<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeclass Collab</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .editor-line {
            font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        }
        .line-number {
            color: #6b7280;
            text-align: right;
            padding-right: 1rem;
            user-select: none;
        }
        .keyword {
            color: #7c3aed;
        }
        .string {
            color: #059669;
        }
        .function {
            color: #2563eb;
        }
        .tab-active {
            border-bottom: 2px solid #3b82f6;
            color: #1f2937;
        }
        .tab-inactive {
            color: #6b7280;
        }
        .file-icon {
            width: 16px;
            height: 16px;
            margin-right: 4px;
        }
        .folder-icon {
            width: 16px;
            height: 16px;
            margin-right: 4px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 py-2 px-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="#" class="text-blue-600 font-bold text-lg mr-8">Codeclass<br>Collab</a>
                    <nav class="flex space-x-4">
                        <button class="px-2 py-1 text-gray-700 hover:bg-gray-100 rounded">File</button>
                        <button class="px-2 py-1 text-gray-700 hover:bg-gray-100 rounded">Edit</button>
                        <button class="px-2 py-1 text-gray-700 hover:bg-gray-100 rounded">View</button>
                    </nav>
                </div>
                <div class="flex items-center">
                    <div class="flex -space-x-2 mr-4">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Collaborator" class="h-8 w-8 rounded-full border-2 border-white">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Collaborator" class="h-8 w-8 rounded-full border-2 border-white">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Collaborator" class="h-8 w-8 rounded-full border-2 border-white">
                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-600 border-2 border-white">+2</div>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded">Share</button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex flex-1 overflow-hidden">
            <!-- File Explorer -->
            <div class="w-48 bg-white border-r border-gray-200 flex flex-col">
                <div class="flex items-center justify-between p-2 border-b border-gray-200">
                    <h2 class="text-sm font-medium text-gray-700">Files</h2>
                    <button class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </button>
                </div>
                <div class="p-2 overflow-y-auto flex-1">
                    <div class="mb-1">
                        <div class="flex items-center text-sm text-gray-700 py-1 hover:bg-gray-100 rounded px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="folder-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            src
                        </div>
                        <div class="ml-4">
                            <div class="flex items-center text-sm text-gray-700 py-1 hover:bg-gray-100 rounded px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="file-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                index.js
                            </div>
                            <div class="flex items-center text-sm text-gray-700 py-1 hover:bg-gray-100 rounded px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="file-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                styles.css
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Editor -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Tabs -->
                <div class="bg-white border-b border-gray-200 flex">
                    <button class="px-4 py-2 text-sm tab-active flex items-center">
                        index.js
                    </button>
                    <button class="px-4 py-2 text-sm tab-inactive flex items-center">
                        styles.css
                    </button>
                </div>
                
                <!-- Code Editor -->
                <div class="flex-1 overflow-auto bg-white">
                    <div class="p-4">
                        <table class="w-full">
                            <tbody>
                                <tr class="editor-line">
                                    <td class="line-number w-8">1</td>
                                    <td><span class="keyword">const</span> express = <span class="function">require</span>(<span class="string">'express'</span>);</td>
                                </tr>
                                <tr class="editor-line">
                                    <td class="line-number">2</td>
                                    <td><span class="keyword">const</span> app = express();</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Comments Panel -->
            <div class="w-64 bg-white border-l border-gray-200 flex flex-col">
                <div class="border-b border-gray-200">
                    <div class="flex">
                        <button class="px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600 flex-1 text-center">
                            Comments
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-500 flex-1 text-center">
                            Chat
                        </button>
                    </div>
                </div>
                
                <div class="flex-1 overflow-y-auto p-4">
                    <div class="mb-6">
                        <div class="flex items-start mb-2">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Chen" class="h-8 w-8 rounded-full mr-2">
                            <div>
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-900">Sarah Chen</span>
                                    <span class="ml-2 text-xs text-gray-500">2min ago</span>
                                </div>
                                <p class="text-sm text-gray-700 mt-1">
                                    Should we add error handling here?
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Line 2
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 p-2">
                    <div class="relative">
                        <input type="text" placeholder="Add a comment..." class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button class="absolute right-2 top-2 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js"></script>
</body>
</html>