@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
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
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Gestion des Badges</h1>
            <p class="text-gray-600">Créez et gérez les badges pour vos étudiants</p>
        </div>

        <!-- Badge Creation Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Créer un nouveau badge</h2>
                    <form id="badgeCreateForm" action="{{ route('badge.store') }}" method="POST">
                        @csrf
                        <div id="badgeFormMessage" class="mb-4"></div>

                        <div class="mb-4">
                            <label for="badge-name" class="block text-sm font-medium text-gray-700 mb-1">Nom du badge</label>
                            <input type="text" id="badge-name" name="name" value="{{ old('name') }}" placeholder="Ex: Expert en JavaScript" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="badge-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="badge-description" name="description" rows="4" placeholder="Décrivez les critères d'obtention..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="badge-category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                            <select id="badge-category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="Développement Web" {{ old('category') == 'Développement Web' ? 'selected' : '' }}>Développement Web</option>
                                <option value="Programmation Mobile" {{ old('category') == 'Programmation Mobile' ? 'selected' : '' }}>Programmation Mobile</option>
                                <option value="Intelligence Artificielle" {{ old('category') == 'Intelligence Artificielle' ? 'selected' : '' }}>Intelligence Artificielle</option>
                                <option value="Bases de Données" {{ old('category') == 'Bases de Données' ? 'selected' : '' }}>Bases de Données</option>
                                <option value="DevOps" {{ old('category') == 'DevOps' ? 'selected' : '' }}>DevOps</option>
                            </select>
                            @error('category')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="points" class="block text-sm font-medium text-gray-700 mb-1">Points attribués</label>
                            <input type="number" id="points" name="points" value="{{ old('points', 100) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                            @error('points')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="points_required" class="block text-sm font-medium text-gray-700 mb-1">Points minimum requis</label>
                            <input type="number" id="points_required" name="points_required" value="{{ old('points_required', 1000) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                            @error('points_required')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="min_points" class="block text-sm font-medium text-gray-700 mb-1">Points minimum pour éligibilité</label>
                            <input type="number" id="min_points" name="min_points" value="{{ old('min_points', 80) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                            @error('min_points')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="min_activity_hours" class="block text-sm font-medium text-gray-700 mb-1">Temps d'activité minimum (heures)</label>
                            <input type="number" id="min_activity_hours" name="min_activity_hours" value="{{ old('min_activity_hours', 10) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                            @error('min_activity_hours')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Temps minimum requis (heures)</label>
                            <input type="number" id="time" name="time" value="{{ old('time', 30) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                            @error('time')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="projects" class="block text-sm font-medium text-gray-700 mb-1">Projets complétés</label>
                            <input type="number" id="projects" name="projects" value="{{ old('projects', 5) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                            @error('projects')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
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

                <!-- Badge List -->
                <div class="mt-12">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Badges existants</h2>
                    @if($badges->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($badges as $badge)
                                <div class="badge-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg">
                                    <div class="p-6">
                                        <div class="flex flex-col items-center text-center">
                                            <img src="{{ asset($badge->image) }}" alt="{{ $badge->name }}" class="w-32 h-32 mb-4">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $badge->name }}</h3>
                                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($badge->description ?? 'Aucune description', 50) }}</p>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                                {{ $badge->created_at->diffForHumans() }}
                                            </div>
                                            <div class="mt-2 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                {{ $badge->points }} points
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun badge créé</h3>
                        </div>
                    @endif
                </div>
            </div>

            <style>
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
                .badge-card {
                    transition: transform 0.2s, box-shadow 0.2s;
                }
                .badge-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const badgeNameInput = document.getElementById('badge-name');
                    const badgePreviewImg = document.getElementById('badge-preview-img');
                    const colorOptions = document.querySelectorAll('.color-option');
                    const levelOptions = document.querySelectorAll('.level-option');
                    const badgeLevelInput = document.getElementById('badge-level');
                    const badgeColorInput = document.getElementById('badge-color');
                    const form = document.getElementById('badgeCreateForm');
                    const messageDiv = document.getElementById('badgeFormMessage');

                    const colorMap = {
                        blue: '3b82f6',
                        green: '10b981',
                        purple: '8b5cf6',
                        red: 'ef4444'
                    };

                    function updateBadgePreview() {
                        const name = badgeNameInput.value || 'Badge';
                        const level = badgeLevelInput.value;
                        const color = colorMap[badgeColorInput.value] || '3b82f6';
                        badgePreviewImg.src = `https://placehold.co/150x150/${color}/FFC107?text=${encodeURIComponent(name)}&font=roboto`;
                        badgePreviewImg.alt = `Aperçu du badge ${name}`;
                    }

                    colorOptions.forEach(option => {
                        option.addEventListener('click', function() {
                            colorOptions.forEach(opt => opt.classList.remove('selected'));
                            this.classList.add('selected');
                            badgeColorInput.value = this.dataset.color;
                            updateBadgePreview();
                        });
                    });

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

                    badgeNameInput.addEventListener('input', updateBadgePreview);
                    updateBadgePreview();

                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const submitButton = form.querySelector('button[type="submit"]');
                        submitButton.disabled = true;
                        submitButton.innerHTML = 'Création en cours...';

                        const formData = new FormData(form);

                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                messageDiv.innerHTML = `<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">${data.success}</div>`;
                                setTimeout(() => {
                                    window.location.href = '{{ route("badges.index") }}';
                                }, 1500);
                            } else {
                                let errorHtml = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"><ul>';
                                if (data.errors) {
                                    for (const field in data.errors) {
                                        errorHtml += `<li>${data.errors[field][0]}</li>`;
                                    }
                                } else {
                                    errorHtml += `<li>${data.error || 'Une erreur est survenue.'}</li>`;
                                }
                                errorHtml += '</ul></div>';
                                messageDiv.innerHTML = errorHtml;
                                submitButton.disabled = false;
                                submitButton.innerHTML = 'Créer le badge';
                            }
                        })
                        .catch(error => {
                            messageDiv.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">Erreur réseau, veuillez réessayer.</div>`;
                            submitButton.disabled = false;
                            submitButton.innerHTML = 'Créer le badge';
                        });
                    });
                });
            </script>
        @endsection