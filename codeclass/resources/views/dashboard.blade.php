<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeclass - Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #e5e7eb;
        }
        .progress-bar-fill-blue {
            height: 100%;
            border-radius: 4px;
            background-color: #4f46e5;
        }
        .progress-bar-fill-green {
            height: 100%;
            border-radius: 4px;
            background-color: #059669;
        }
        .badge-blue {
            background-color: #e0e7ff;
            color: #4f46e5;
        }
        .badge-yellow {
            background-color: #fef3c7;
            color: #d97706;
        }
        .badge-green {
            background-color: #d1fae5;
            color: #059669;
        }
        .card-purple {
            background-color: #4f46e5;
        }
        .card-blue {
            background-color: #2563eb;
        }
        .card-purple-light {
            background-color: #7c3aed;
        }
        .card-green {
            background-color: #059669;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <header class="flex items-center justify-between py-4 border-b border-gray-200">
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-indigo-600">codeclass</a>
                <nav class="hidden md:flex ml-10 space-x-8">
    <a href="{{ route('dashboard') }}" class="text-gray-900 font-medium">Dashboard</a>
    <a href="{{ route('projects') }}" class="text-gray-500 hover:text-gray-900">Projets</a>
    <a href="{{ route('ressources') }}" class="text-gray-500 hover:text-gray-900">Ressources</a>
    <a href="{{ route('community') }}" class="text-gray-500 hover:text-gray-900">Community</a>
</nav>
            </div>
            <div class="flex items-center">
                <!-- Bouton Notifications -->
                <a href="{{ route('notifications.student') }}" class="mr-4 text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </a>
             <!-- Skills Button -->
    <a href="{{ url('/skills') }}" class="ml-4 btn-purple py-2 px-4 rounded-md flex items-center">
        <svg xmlns="[http://www.w3.org/2000/svg"](http://www.w3.org/2000/svg") class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01.88 7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
        </svg>
        Mes Compétences
    </a>
    <a href="{{ route('skills.gaps_recommendations') }}" class="btn-green py-2 px-4 rounded-md flex items-center">
    Recommandations pour mes lacunes
</a>
                <!-- Avatar -->
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="h-8 w-8 rounded-full">
            
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="ml-4">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
                        Logout
                    </button>
                </form>
            </div>
        </header>

       <!-- Welcome Section -->
<div class="py-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Bonjour, {{ $user->name }}</h1>
        <p class="text-gray-600">Continuez votre progression</p>
    </div>
    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md">
        Commencer
    </button>
</div>

<!-- Stats Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Global Progress -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-gray-700 font-medium mb-4">Progression globale</h2>
        <div class="flex justify-between items-center mb-2">
            <span class="text-3xl font-bold text-indigo-600">{{ $globalProgress }}%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-bar-fill-blue" style="width: {{ $globalProgress }}%"></div>
        </div>
    </div>

    <!-- Completed Projects -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-gray-700 font-medium mb-4">Projets complétés</h2>
        <div class="flex justify-between items-center mb-2">
            <span class="text-3xl font-bold text-green-600">{{ $completedProjects }}</span>
        </div>
        <p class="text-gray-600 text-sm">{{ $projectsThisWeek }} projets cette semaine</p>
    </div>

    <!-- Learning Time -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-gray-700 font-medium mb-4">Temps d'apprentissage</h2>
        <div class="flex justify-between items-center mb-2">
            <span class="text-3xl font-bold text-blue-600">{{ $learningTimeHours }}h</span>
        </div>
        <p class="text-gray-600 text-sm">+{{ $learningTimeThisWeek }}h depuis la semaine dernière</p>
    </div>
</div>

<!-- Current Projects Section -->
<div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-900">Projets en cours</h2>
        <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Voir tout</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($projectCards as $project)
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    @php
                        // Choose badge class based on status
                        $badgeClass = 'badge-blue';
                        if ($project['status'] === 'À débuter') $badgeClass = 'badge-yellow';
                        elseif ($project['status'] === 'Presque fini') $badgeClass = 'badge-green';
                    @endphp
                    <span class="{{ $badgeClass }} px-3 py-1 rounded-full text-xs font-medium">{{ $project['status'] }}</span>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="[http://www.w3.org/2000/svg"](http://www.w3.org/2000/svg") class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </button>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $project['name'] }}</h3>
                <div class="flex items-center text-gray-500 mb-4">
                    <svg xmlns="[http://www.w3.org/2000/svg"](http://www.w3.org/2000/svg") class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm">{{ $project['time_remaining'] }}</span>
                </div>
                <div class="progress-bar">
                    <div class="{{ $project['progress'] >= 90 ? 'progress-bar-fill-green' : 'progress-bar-fill-blue' }}" style="width: {{ $project['progress'] }}%"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Courses Card -->
            <div class="card-purple text-white p-6 rounded-lg">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Cours</h3>
                <p class="text-indigo-100 mb-6">Accédez à tous vos cours</p>
                <a href="{{ route('courses') }}"class="bg-white text-indigo-600 hover:bg-indigo-50 font-medium py-2 px-4 rounded-md text-sm">
                    Explorer
    </a>
            </div>

            <!-- Community Card -->
            <div class="card-blue text-white p-6 rounded-lg">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Community</h3>
                <p class="text-blue-100 mb-6">Rejoignez les discussions</p>
                <a href="{{ route('community') }}" class="bg-white text-blue-600 hover:bg-blue-50 font-medium py-2 px-4 rounded-md text-sm">
                    Participer
    </a>
            </div>

            <!-- Challenges Card -->
            <div class="card-purple-light text-white p-6 rounded-lg">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Challenges</h3>
                <p class="text-purple-100 mb-6">Testez vos compétences</p>
                <a href="{{ route('challenges') }}" class="bg-white text-purple-600 hover:bg-purple-50 font-medium py-2 px-4 rounded-md text-sm">
                    Défier
                </a>
            </div>

            <!-- Certifications Card -->
            <div class="card-green text-white p-6 rounded-lg">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Certifications</h3>
                <p class="text-green-100 mb-6">Obtenez vos badges</p>
                <a href="{{ route('certifications') }}" class="bg-white text-green-600 hover:bg-green-50 font-medium py-2 px-4 rounded-md text-sm">
                    Découvrir
                </a>
            </div>
        </div>
    </div>
</body>
</html>