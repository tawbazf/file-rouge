<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Pédagogique</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #e5e7eb;
        }
        .progress-math {
            background-color: #3b82f6;
        }
        .progress-science {
            background-color: #10b981;
        }
        .progress-history {
            background-color: #8b5cf6;
        }
        .progress-emma {
            background-color: #10b981;
        }
        .progress-lucas {
            background-color: #f59e0b;
        }
        .grade-low {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        .grade-medium-low {
            background-color: #ffedd5;
            color: #c2410c;
        }
        .grade-medium {
            background-color: #fef3c7;
            color: #b45309;
        }
        .grade-medium-high {
            background-color: #d1fae5;
            color: #065f46;
        }
        .grade-high {
            background-color: #dbeafe;
            color: #1e40af;
        
    </style>
</head>
<body>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Tableau de Bord Pédagogique</h1>
            <div class="flex items-center">
                <button class="mr-4 text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="h-8 w-8 rounded-full mr-2">
                    <span class="text-gray-700">Prof. Martin</span>
                </div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Moyenne de la classe -->
            <div class="card p-6">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm text-gray-500">Moyenne de la classe</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="flex items-end">
                <span class="text-3xl font-bold text-gray-900">{{ $classAverage }}</span>
                <span class="ml-2 text-sm text-green-500">{{ $classAverageChange }}</span>
                </div>
            </div>

            <!-- Étudiants actifs -->
            <div class="card p-6">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm text-gray-500">Étudiants actifs</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="flex items-end">
                <span class="text-3xl font-bold text-gray-900">{{ $activeStudents }}</span>
                <span class="ml-2 text-sm text-gray-500">/ {{ $totalStudents }}</span>
                </div>
            </div>

            <!-- Devoirs rendus -->
            <div class="card p-6">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm text-gray-500">Devoirs rendus</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="flex items-end">
                <span class="text-3xl font-bold text-gray-900">{{ $homeworkSubmitted }}%</span>
                </div>
            </div>

            <!-- Progrès global -->
            <div class="card p-6">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm text-gray-500">Progrès global</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div class="flex items-end">
                <span class="text-3xl font-bold text-gray-900">{{ $globalProgress }}%</span>
                </div>
            </div>
        </div>

        <!-- Progression & Distribution -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Progression par matière -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Progression par matière</h2>
                
                <!-- Mathématiques -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-700">Mathématiques</span>
                        <span class="text-sm font-medium text-gray-900">85%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-math h-full rounded-full" style="width: 85%"></div>
                    </div>
                </div>
                
                <!-- Sciences -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-700">Sciences</span>
                        <span class="text-sm font-medium text-gray-900">72%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-science h-full rounded-full" style="width: 72%"></div>
                    </div>
                </div>
                
                <!-- Histoire -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-700">Histoire</span>
                        <span class="text-sm font-medium text-gray-900">68%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-history h-full rounded-full" style="width: 68%"></div>
                    </div>
                </div>
            </div>

            <!-- Distribution des notes -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Distribution des notes</h2>
                <div class="grid grid-cols-5 gap-2">
                    <div class="text-center">
                        <div class="grade-low rounded-md p-3 mb-2">
                            <span class="text-lg font-bold">{{ $gradeDistribution['0-5'] }}</span>
                        </div>
                        <span class="text-xs text-gray-500">0-5</span>
                    </div>
                    <div class="text-center">
                        <div class="grade-medium-low rounded-md p-3 mb-2">
                            <span class="text-lg font-bold">5</span>
                        </div>
                        <span class="text-xs text-gray-500">6-10</span>
                    </div>
                    <div class="text-center">
                        <div class="grade-medium rounded-md p-3 mb-2">
                            <span class="text-lg font-bold">12</span>
                        </div>
                        <span class="text-xs text-gray-500">11-14</span>
                    </div>
                    <div class="text-center">
                        <div class="grade-medium-high rounded-md p-3 mb-2">
                            <span class="text-lg font-bold">8</span>
                        </div>
                        <span class="text-xs text-gray-500">15-17</span>
                    </div>
                    <div class="text-center">
                        <div class="grade-high rounded-md p-3 mb-2">
                            <span class="text-lg font-bold">3</span>
                        </div>
                        <span class="text-xs text-gray-500">18-20</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des étudiants -->
        <div class="card p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Liste des étudiants</h2>
                <div class="flex space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher un étudiant..." class="w-64 pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filtrer
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Moyenne</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progression</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernière activité</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
@foreach($studentRows as $student)
<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full" src="{{ $student['avatar'] }}" alt="">
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">{{ $student['name'] }}</div>
                <div class="text-sm text-gray-500">ID: {{ $student['id'] }}</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 text-sm text-green-800 bg-green-100 rounded-full">{{ $student['average'] }}</span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="w-48 progress-bar">
            <div class="progress-emma h-full rounded-full" style="width: {{ $student['progress'] }}%"></div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        {{ $student['last_activity'] }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
        <a href="#" class="hover:text-blue-800">Détails</a>
    </td>
</tr>
@endforeach
</tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-500">
                    Affichage de 2 étudiants sur 30
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                        Précédent
                    </button>
                    <button class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm">
                        1
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                        2
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                        3
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                        Suivant
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>