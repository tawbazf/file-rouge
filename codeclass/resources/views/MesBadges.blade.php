<!-- resources/views/MesBadges.blade.php -->
@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p class="font-bold">Succès !</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <h1 class="text-2xl font-bold text-gray-900 mb-6">Mes Badges</h1>

    @if($badges->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($badges as $badge)
                <div class="badge-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex flex-col items-center text-center">
                            <img src="{{ $badge['image'] }}" alt="{{ $badge['name'] }}" class="w-32 h-32 mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $badge['name'] }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($badge['description'], 50) }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $badge['awarded_at'] }}
                            </div>
                            <div class="mt-2 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                {{ $badge['points'] }} points
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right">
                        <button data-badge-id="{{ $badge['id'] }}" class="show-badge-details text-sm font-medium text-blue-600 hover:text-blue-500">
                            Voir les détails
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($badges->hasPages())
            <div class="mt-8">
                {{ $badges->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun badge trouvé</h3>
        </div>
    @endif

    <!-- Modal for Badge Details -->
    <div id="badgeModal" class="modal">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h2 id="modalBadgeName" class="text-xl font-semibold text-gray-900"></h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">×</button>
            </div>
            <img id="modalBadgeImage" src="" alt="" class="w-48 h-48 mx-auto mb-4">
            <p id="modalBadgeDescription" class="text-gray-600 mb-4"></p>
            <p id="modalBadgeLevel" class="text-sm text-gray-500 mb-1"></p>
            <p id="modalBadgeCategory" class="text-sm text-gray-500 mb-1"></p>
            <p id="modalBadgePoints" class="text-sm text-gray-500 mb-1"></p>
            <p id="modalBadgeAwarded" class="text-sm text-gray-500 mb-1"></p>
            <p id="modalBadgeCriteria" class="text-sm text-gray-500"></p>
        </div>
    </div>
</div>

<style>
    .badge-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .badge-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    }
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    .modal-content {
        background-color: white;
        padding: 24px;
        border-radius: 8px;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
    }
    .modal.show {
        display: flex;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('badgeModal');
        const closeModalButton = document.getElementById('closeModal');
        const badgeDetailsButtons = document.querySelectorAll('.show-badge-details');

        const badges = @json($badges);

        badgeDetailsButtons.forEach(button => {
            button.addEventListener('click', function() {
                const badgeId = this.dataset.badgeId;
                const badge = badges[badgeId];

                if (badge) {
                    document.getElementById('modalBadgeName').textContent = badge.name;
                    document.getElementById('modalBadgeImage').src = badge.image;
                    document.getElementById('modalBadgeImage').alt = badge.name;
                    document.getElementById('modalBadgeDescription').textContent = badge.description;
                    document.getElementById('modalBadgeLevel').textContent = `Niveau: ${badge.level}`;
                    document.getElementById('modalBadgeCategory').textContent = `Catégorie: ${badge.category}`;
                    document.getElementById('modalBadgePoints').textContent = `Points: ${badge.points}`;
                    document.getElementById('modalBadgeAwarded').textContent = `Attribué: ${badge.awarded_at}`;
                    document.getElementById('modalBadgeCriteria').textContent = badge.criteria;

                    modal.classList.add('show');
                }
            });
        });

        closeModalButton.addEventListener('click', function() {
            modal.classList.remove('show');
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    });
</script>
@endsection