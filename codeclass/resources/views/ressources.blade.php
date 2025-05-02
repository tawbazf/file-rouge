<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ressources</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-blue-700 text-white p-4 shadow-md">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold">CodeClass</a>
            <div class="flex space-x-4">
                <a href="/dashboard" class="hover:underline">Dashboard</a>
                <a href="/courses" class="hover:underline">Cours</a>
                <a href="/challenges" class="hover:underline">Challenges</a>
                <a href="/ressources" class="hover:underline font-semibold">Ressources</a>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-blue-700">Ressources Utiles</h1>
            <button onclick="openAddResourceModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                + Ajouter une ressource
            </button>
        </div>
        
        <!-- Search Bar -->
        <div class="mb-8">
            <div class="relative">
                <input type="text" id="resourceSearch" placeholder="Rechercher une ressource..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <span class="absolute right-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
            </div>
        </div>
        
        <!-- Resource Categories -->
        <div class="flex flex-wrap gap-2 mb-6">
            <button class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-sm font-medium">Tous</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm">Documentation</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm">Tutoriels</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm">Outils</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm">Livres</button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($ressources as $ressource)
                <div class="bg-white rounded-lg shadow p-6 flex flex-col">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $ressource->title }}</h2>
                    <p class="text-gray-600 flex-1 mb-4">{{ $ressource->description }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ $ressource->url }}" target="_blank" class="text-blue-600 hover:underline font-medium">Voir la ressource</a>
                        <span class="text-xs text-gray-500">Ajouté le {{ $ressource->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add Resource Modal -->
    <div id="addResourceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button onclick="closeAddResourceModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="text-xl font-semibold mb-4 text-center">Ajouter une ressource</h2>
            <form action="/ressources" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                    <input type="text" id="title" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                    <input type="url" id="url" name="url" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <option value="documentation">Documentation</option>
                        <option value="tutoriels">Tutoriels</option>
                        <option value="outils">Outils</option>
                        <option value="livres">Livres</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">Ajouter</button>
            </form>
        </div>
    </div>

    <script>
        function openAddResourceModal() {
            document.getElementById('addResourceModal').classList.remove('hidden');
        }
        
        function closeAddResourceModal() {
            document.getElementById('addResourceModal').classList.add('hidden');
        }
        
        // Search functionality
        document.getElementById('resourceSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const resources = document.querySelectorAll('.grid > div');
            
            resources.forEach(resource => {
                const title = resource.querySelector('h2').textContent.toLowerCase();
                const description = resource.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    resource.style.display = 'flex';
                } else {
                    resource.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
