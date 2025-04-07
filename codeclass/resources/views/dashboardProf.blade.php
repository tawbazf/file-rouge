<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Projets Pédagogiques</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .badge-green {
            background-color: #d1fae5;
            color: #059669;
        }
        .badge-yellow {
            background-color: #fef3c7;
            color: #d97706;
        }
        .badge-red {
            background-color: #fee2e2;
            color: #dc2626;
        }
        .btn-purple {
            background-color: #6366f1;
            color: white;
        }
        .btn-purple:hover {
            background-color: #4f46e5;
        }
        .btn-green {
            background-color: #10b981;
            color: white;
        }
        .btn-green:hover {
            background-color: #059669;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <header class="flex items-center justify-between py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="bg-indigo-600 p-2 rounded-md mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Gestion de Projets Pédagogiques</h1>
            </div>
<div class="flex items-center">
    <!-- Bouton Notifications -->
    <a href="{{ route('notifications.teacher') }}" class="mr-4 text-gray-400 hover:text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
    </a>
    <!-- Avatar avec lien vers les statistiques générales -->
    <a href="{{ route('general.statistics') }}" class="flex items-center">
        <img src="{{ $teacher->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg' }}" alt="Avatar" class="h-8 w-8 rounded-full mr-2">
        <span class="text-gray-700"> Bonjour Prof {{ $teacher->name }}</span>
    </a>
</div>
        </header>

        <!-- Action Buttons -->
        <div class="py-6 flex flex-wrap items-center justify-between">
            <div class="flex space-x-4 mb-4 sm:mb-0">
                <button class="btn-purple py-2 px-4 rounded-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nouveau Projet
                </button>
                <button class="btn-green py-2 px-4 rounded-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Attribuer des Droits
                </button>
            </div>
            <div class="flex space-x-4 w-full sm:w-auto">
                <div class="relative flex-grow max-w-xs">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Rechercher..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="relative inline-block text-left">
                    <button type="button" class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                        Tous les Projets
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Projects Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Projet Web Full-Stack -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Projet Web Full-Stack</h2>
                    <span class="badge-green px-3 py-1 rounded-full text-xs font-medium">En cours</span>
                </div>
                <p class="text-gray-600 text-sm mb-4">Développement d'une application web complète avec React et Node.js</p>
                <div class="flex items-center text-gray-500 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm">Échéance: 15 Mai 2025</span>
                </div>
                <div class="flex items-center text-gray-500 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                    </svg>
                    <span class="text-sm">3 dépôts</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex -space-x-2">
                        <img class="h-8 w-8 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/women/32.jpg" alt="">
                        <img class="h-8 w-8 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/men/45.jpg" alt="">
                        <img class="h-8 w-8 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/women/68.jpg" alt="">
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- API REST -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-lg font-medium text-gray-900">API REST</h2>
                    <span class="badge-yellow px-3 py-1 rounded-full text-xs font-medium">À venir</span>
                </div>
                <p class="text-gray-600 text-sm mb-4">Création d'une API REST avec authentification</p>
                <div class="flex items-center text-gray-500 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm">Échéance: 30 Mai 2025</span>
                </div>
                <div class="flex items-center text-gray-500 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                    </svg>
                    <span class="text-sm">2 dépôts</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex -space-x-2">
                        <img class="h-8 w-8 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/men/22.jpg" alt="">
                        <img class="h-8 w-8 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/women/45.jpg" alt="">
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Base de Données NoSQL -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Base de Données NoSQL</h2>
                    <span class="badge-red px-3 py-1 rounded-full text-xs font-medium">Urgent</span>
                </div>
                <p class="text-gray-600 text-sm mb-4">Conception et implémentation d'une base MongoDB</p>
                <div class="flex items-center text-gray-500 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm">Échéance: 10 Mai 2025</span>
                </div>
                <div class="flex items-center text-gray-500 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                    </svg>
                    <span class="text-sm">4 dépôts</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex -space-x-2">
                        <img class="h-8 w-8 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/women/22.jpg" alt="">
                        <img class="h-8 w-8 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                        <img class="h-8 w-8 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/women/55.jpg" alt="">
                        <div class="h-8 w-8 rounded-full ring-2 ring-white bg-gray-200 flex items-center justify-center text-xs text-gray-500">+2</div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- GitHub Repositories -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Dépôts GitHub</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Projet</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernier Commit</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                    <span class="text-sm text-gray-900">projet-web-2025</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full mr-2" src="https://randomuser.me/api/portraits/women/32.jpg" alt="">
                                    <span class="text-sm text-gray-900">Alice Martin</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Il y a 2 heures
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Actif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">
                                <a href="#" class="hover:text-indigo-900">Voir</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>