@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Badges</h1>
        <p class="text-gray-600 mt-2">Tous les badges disponibles sur la plateforme</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex justify-between items-center">
        <div class="flex space-x-4">
            <div>
                <label for="category-filter" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                <select id="category-filter" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="all">Toutes les catégories</option>
                    <option value="Développement Web">Développement Web</option>
                    <option value="Programmation Mobile">Programmation Mobile</option>
                    <option value="Intelligence Artificielle">Intelligence Artificielle</option>
                    <option value="Bases de Données">Bases de Données</option>
                    <option value="DevOps">DevOps</option>
                </select>
            </div>
            <div>
                <label for="level-filter" class="block text-sm font-medium text-gray-700 mb-1">Niveau</label>
                <select id="level-filter" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="all">Tous les niveaux</option>
                    <option value="Bronze">Bronze</option>
                    <option value="Argent">Argent</option>
                    <option value="Or">Or</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="badges-container">
        @forelse($badges as $badge)
            <div class="badge-item bg-white rounded-lg shadow-md overflow-hidden" 
                 data-category="{{ $badge->category }}" 
                 data-level="{{ $badge->level }}">
                <div class="p-6">
                    <div class="flex justify-center mb-4">
                        <div class="w-24 h-24 rounded-full flex items-center justify-center" 
                             style="background-color: {{ $badge->color === 'blue' ? '#3b82f6' : ($badge->color === 'green' ? '#10b981' : ($badge->color === 'purple' ? '#8b5cf6' : '#ef4444')) }}">
                            <span class="text-white text-xl font-bold">{{ strtoupper(substr($badge->name, 0, 2)) }}</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 text-center mb-2">{{ $badge->name }}</h3>
                    <div class="flex justify-center mb-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            {{ $badge->level === 'Bronze' ? 'bg-yellow-100 text-yellow-800' : 
                               ($badge->level === 'Argent' ? 'bg-gray-100 text-gray-800' : 'bg-yellow-300 text-yellow-900') }}">
                            {{ $badge->level }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                            {{ $badge->category }}
                        </span>
                    </div>
                    <p class="text-gray-600 text-center mb-4 line-clamp-3">{{ $badge->description }}</p>
                    <div class="flex justify-between text-sm text-gray-500 border-t border-gray-200 pt-4">
                        <div>
                            <span class="font-medium">Points:</span> {{ $badge->points }}
                        </div>
                        <div>
                            <span class="font-medium">Min. requis:</span> {{ $badge->min_points }}
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 flex justify-between">
                    <button type="button" onclick="showBadgeDetails({{ $badge->id }})" 
                            class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        Voir détails
                    </button>
                    <div class="flex space-x-2">
                        <a href="{{ route('badge.edit', $badge->id) }}" class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                        <form action="{{ route('badge.destroy', $badge->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce badge?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Aucun badge trouvé</h3>
                <p class="text-gray-500 mb-4">Vous n'avez pas encore créé de badges.</p>
                <a href="{{ route('badge.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Créer votre premier badge
                </a>
            </div>
        @endforelse
    </div>

    @if($badges->hasPages())
        <div class="mt-6">
            {{ $badges->links() }}
        </div>
    @endif
</div>

<!-- Badge Details Modal -->
<div id="badgeDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900" id="modal-badge-name">Nom du badge</h2>
                <button type="button" onclick="closeBadgeDetails()" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex justify-center mb-4">
                <div id="modal-badge-icon" class="w-24 h-24 rounded-full flex items-center justify-center">
                    <span class="text-white text-xl font-bold" id="modal-badge-initials">XX</span>
                </div>
            </div>
            <div class="mb-4 text-center">
                <span id="modal-badge-level" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    Niveau
                </span>
                <span id="modal-badge-category" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 ml-2">
                    Catégorie
                </span>
            </div>
            <div class="mb-4">
                <h3 class="text-sm font-medium text-gray-700 mb-1">Description</h3>
                <p id="modal-badge-description" class="text-sm text-gray-600">Description du badge</p>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-1">Points</h3>
                    <p id="modal-badge-points" class="text-sm text-gray-600">0</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-1">Points minimum requis</h3>
                    <p id="modal-badge-min-points" class="text-sm text-gray-600">0</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-1">Temps d'activité minimum</h3>
                    <p id="modal-badge-min-activity" class="text-sm text-gray-600">0 heures</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-1">Projets complétés</h3>
                    <p id="modal-badge-projects" class="text-sm text-gray-600">0</p>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-3 flex justify-end rounded-b-lg">
            <button type="button" onclick="closeBadgeDetails()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Fermer
            </button>
        </div>
    </div>
</div>

<script>
 
    function filterBadges() {
        const categoryFilter = document.getElementById('category-filter').value;
        const levelFilter = document.getElementById('level-filter').value;
        const badgeItems = document.querySelectorAll('.badge-item');
        
        badgeItems.forEach(item => {
            const category = item.dataset.category;
            const level = item.dataset.level;
            
            const categoryMatch = categoryFilter === 'all' || category === categoryFilter;
            const levelMatch = levelFilter === 'all' || level === levelFilter;
            
            if (categoryMatch && levelMatch) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    }
    
    
    function showBadgeDetails(badgeId) {
       
        const badgeItem = document.querySelector(`.badge-item[data-badge-id="${badgeId}"]`);
        
        if (!badgeItem) {
         
            fetch(`/badges/${badgeId}`)
                .then(response => response.json())
                .then(badge => {
                    populateBadgeModal(badge);
                    document.getElementById('badgeDetailsModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching badge details:', error);
                });
            return;
            }}