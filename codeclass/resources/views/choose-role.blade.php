<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir votre rôle</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .card-selected {
            border: 2px solid #4f46e5;
            background-color: #f5f3ff;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="max-w-4xl w-full bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Bienvenue sur notre plateforme</h1>
                <p class="text-gray-600">Veuillez choisir votre rôle pour continuer</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Carte Utilisateur -->
                <div id="user-card" class="bg-white border border-gray-200 rounded-lg p-6 text-center cursor-pointer transition duration-300 card-hover" onclick="selectRole('user')">
                    <div class="bg-blue-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Utilisateur</h2>
                    <p class="text-gray-600 mb-4">Accédez à tous les cours et ressources pédagogiques</p>
                </div>

                <!-- Carte Enseignant -->
                <div id="teacher-card" class="bg-white border border-gray-200 rounded-lg p-6 text-center cursor-pointer transition duration-300 card-hover" onclick="selectRole('teacher')">
                    <div class="bg-indigo-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5-9-5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Enseignant</h2>
                    <p class="text-gray-600 mb-4">Créez et gérez vos propres cours et projets</p>
                </div>
            </div>

            <!-- Formulaire supplémentaire pour les enseignants -->
            <div id="teacher-form" class="hidden bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informations supplémentaires pour les enseignants</h3>
                <form method="POST" action="{{ route('choose.role.submit') }}">
                    @csrf
                    <input type="hidden" name="role" value="teacher">
                    <div class="mb-4">
                        <label for="speciality" class="block text-sm font-medium text-gray-700 mb-1">Spécialité</label>
                        <input type="text" id="speciality" name="speciality" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Soumettre
                    </button>
                </form>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end">
                <button id="continue-button" onclick="submitForm()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50" disabled>
                    Continuer
                </button>
            </div>
        </div>
    </div>

    <script>
        let selectedRole = null;
        const userCard = document.getElementById('user-card');
        const teacherCard = document.getElementById('teacher-card');
        const teacherForm = document.getElementById('teacher-form');
        const continueButton = document.getElementById('continue-button');

        function selectRole(role) {
            selectedRole = role;

            // Réinitialiser les styles des cartes
            userCard.classList.remove('card-selected');
            teacherCard.classList.remove('card-selected');

            // Appliquer le style à la carte sélectionnée
            if (role === 'user') {
                userCard.classList.add('card-selected');
                teacherForm.classList.add('hidden');
            } else if (role === 'teacher') {
                teacherCard.classList.add('card-selected');
                teacherForm.classList.remove('hidden');
            }

            // Activer le bouton Continuer
            continueButton.disabled = false;
        }

        function submitForm() {
            if (selectedRole === 'user') {
                // Rediriger vers la page d'accueil des utilisateurs
                window.location.href = "{{ route('dashboard') }}";
            } else if (selectedRole === 'teacher') {
                // Soumettre le formulaire d'enseignant
                document.querySelector('#teacher-form form').submit();
            }
        }
    </script>
</body>
</html>