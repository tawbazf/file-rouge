<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un badge | Codeclass</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .badge-preview {
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }
        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .color-option.selected {
            border-color: #6b7280;
        }
        .color-blue { background-color: #3b82f6; }
        .color-green { background-color: #10b981; }
        .color-purple { background-color: #8b5cf6; }
        .color-red { background-color: #ef4444; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-blue-600 font-bold text-2xl mr-10">codeclass</a>
                    <nav class="hidden md:flex space-x-8">
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-900">Tableau de bord</a>
                        <a href="{{ route('badges.index') }}" class="text-gray-500 hover:text-gray-900">Mes badges</a>
                        <a href="{{ route('badge.create') }}" class="text-blue-600 font-medium">Créer</a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">Statistiques</a>
                    </nav>
                </div>
                <div class="flex items-center">
                    <button class="mr-4 text-gray-400 hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <img src="{{ Auth::user()->avatar ?? 'https://randomuser.me/api/portraits/women/32.jpg' }}" alt="Avatar" class="h-8 w-8 rounded-full">
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Créer un nouveau badge</h1>
                    <p class="text-gray-600">Définissez les critères et le design de votre badge</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Badge Information -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-6">Informations du badge</h2>
                            <form action="{{ route('badge.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="badge-name" class="block text-sm font-medium text-gray-700 mb-1">Nom du badge</label>
                                    <input type="text" id="badge-name" name="name" placeholder="Ex: Expert en JavaScript" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="badge-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea id="badge-description" name="description" rows="4" placeholder="Décrivez les critères d'obtention..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                    @error('description')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="badge-category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                                    <div class="relative">
                                        <select id="badge-category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                            <option value="Développement Web">Développement Web</option>
                                            <option value="Programmation Mobile">Programmation Mobile</option>
                                            <option value="Intelligence Artificielle">Intelligence Artificielle</option>
                                            <option value="Bases de Données">Bases de Données</option>
                                            <option value="DevOps">DevOps</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('category')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-6">Critères d'obtention</h2>
                            
                            <div class="mb-6">
                                <div class="flex items-center mb-2">
                                    <div class="flex-shrink-0 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                    <label for="points" class="block text-sm font-medium text-gray-700">Points minimum requis</label>
                                </div>
                                <div class="ml-9">
                                    <input type="number" id="points" name="points_required" value="1000" class="w-32 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    @error('points_required')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <div class="flex items-center mb-2">
                                    <div class="flex-shrink-0 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <label for="time" class="block text-sm font-medium text-gray-700">Temps d'activité minimum</label>
                                </div>
                                <div class="ml-9 flex items-center">
                                    <input type="number" id="time" name="time" value="30" class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <span class="ml-2 text-gray-700">heures</span>
                                    @error('time')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex items-center mb-2">
                                    <div class="flex-shrink-0 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                    </div>
                                    <label for="projects" class="block text-sm font-medium text-gray-700">Projets complétés</label>
                                </div>
                                <div class="ml-9">
                                    <input type="number" id="projects" name="projects" value="5" class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    @error('projects')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Badge Preview -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-sm p-6 sticky top-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-6 text-center">Aperçu du badge</h2>
                            
                            <div class="badge-preview mb-6">
                                <img id="badge-preview-img" src="https://placehold.co/150x150/3b82f6/FFC107?text=Badge&font=roboto" alt="Aperçu du badge" class="w-full h-full object-contain">
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-700 mb-3 text-center">Niveau</h3>
                                <div class="flex justify-center space-x-2">
                                    <button type="button" class="level-option px-4 py-1 text-sm bg-gray-100 text-gray-800 rounded-md" data-level="Bronze">Bronze</button>
                                    <button type="button" class="level-option px-4 py-1 text-sm bg-blue-600 text-white rounded-md" data-level="Argent">Argent</button>
                                    <button type="button" class="level-option px-4 py-1 text-sm bg-gray-100 text-gray-800 rounded-md" data-level="Or">Or</button>
                                </div>
                                <input type="hidden" id="badge-level" name="level" value="Argent">
                                @error('level')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-8">
                                <h3 class="text-sm font-medium text-gray-700 mb-3 text-center">Couleurs</h3>
                                <div class="flex justify-center space-x-3">
                                    <div class="color-option color-blue selected" data-color="blue"></div>
                                    <div class="color-option color-green" data-color="green"></div>
                                    <div class="color-option color-purple" data-color="purple"></div>
                                    <div class="color-option color-red" data-color="red"></div>
                                </div>
                                <input type="hidden" id="badge-color" name="color" value="blue">
                                @error('color')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Créer le badge
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-gray-500 mb-4 md:mb-0">
                    © 2025 codeclass. Tous droits réservés.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900">Aide</a>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900">Conditions</a>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900">Confidentialité</a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const badgeNameInput = document.getElementById('badge-name');
            const badgePreviewImg = document.getElementById('badge-preview-img');
            const colorOptions = document.querySelectorAll('.color-option');
            const levelOptions = document.querySelectorAll('.level-option');
            const badgeLevelInput = document.getElementById('badge-level');
            const badgeColorInput = document.getElementById('badge-color');

            // Color to hex mapping
            const colorMap = {
                blue: '3b82f6',
                green: '10b981',
                purple: '8b5cf6',
                red: 'ef4444'
            };

            // Update badge preview
            function updateBadgePreview() {
                const name = badgeNameInput.value || 'Badge';
                const level = badgeLevelInput.value;
                const color = colorMap[badgeColorInput.value] || '3b82f6';
                badgePreviewImg.src = `https://placehold.co/150x150/${color}/FFC107?text=${encodeURIComponent(name)}&font=roboto`;
                badgePreviewImg.alt = `Aperçu du badge ${name}`;
            }

            // Color selection
            colorOptions.forEach(option => {
                option.addEventListener('click', function() {
                    colorOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    badgeColorInput.value = this.dataset.color;
                    updateBadgePreview();
                });
            });

            // Level selection
            levelOptions.forEach(option => {
                option.addEventListener('click', function() {
                    levelOptions.forEach(opt => opt.classList.remove('bg-blue-600', 'text-white'));
                    levelOptions.forEach(opt => opt.classList.add('bg-gray-100', 'text-gray-800'));
                    this.classList.remove('bg-gray-100', 'text-gray-800');
                    this.classList.add('bg-blue-600', 'text-white');
                    badgeLevelInput.value = this.dataset.level;
                    updateBadgePreview();
                });
            });

            // Real-time name update
            badgeNameInput.addEventListener('input', updateBadgePreview);

            // Initial preview
            updateBadgePreview();
        });
    </script>
</body>
</html>