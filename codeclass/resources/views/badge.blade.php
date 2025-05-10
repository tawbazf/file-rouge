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
</body>
</html>