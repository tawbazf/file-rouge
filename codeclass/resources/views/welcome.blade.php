<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur CodeClass</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-blue-100 min-h-screen">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <svg class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-2xl font-bold text-indigo-700">CodeClass</span>
            </div>
            <nav class="space-x-6">
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Connexion</a>
                <a href="{{ route('register') }}" class="text-white bg-indigo-600 px-4 py-2 rounded-md shadow hover:bg-indigo-700 transition">Inscription</a>
            </nav>
        </div>
    </header>
    <main class="flex flex-col items-center justify-center py-20 px-4">
        <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-800 mb-6 text-center">
            Plateforme pédagogique moderne pour enseignants et étudiants
        </h1>
        <p class="text-xl text-gray-700 mb-10 max-w-2xl text-center">
            Gérez vos projets, attribuez des badges, collaborez en temps réel, suivez la progression et accédez à des ressources personnalisées. 
            <br>
            Rejoignez la communauté CodeClass dès aujourd’hui !
        </p>
        <div class="flex flex-col md:flex-row gap-4 mb-12">
            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold shadow hover:bg-indigo-700 transition">Commencer</a>
            <a href="{{ route('login') }}" class="bg-white border border-indigo-600 text-indigo-700 px-8 py-3 rounded-lg font-semibold shadow hover:bg-indigo-50 transition">Déjà inscrit ? Se connecter</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8 max-w-5xl">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-indigo-600 mb-2">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h2 class="font-bold text-lg mb-2">Gestion de projets</h2>
                <p class="text-gray-600">Créez, attribuez et suivez des projets pédagogiques avec gestion automatique des dépôts GitHub.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-yellow-500 mb-2">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 17l-5 3 1-5.4L3 9.5l5.4-.8L12 4l2.6 4.7 5.4.8-3.9 3.1 1 5.4z"/>
                    </svg>
                </div>
                <h2 class="font-bold text-lg mb-2">Système de badges</h2>
                <p class="text-gray-600">Récompensez les compétences et la progression grâce à un système de badges personnalisés.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-green-500 mb-2">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 20h5v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2h5"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                <h2 class="font-bold text-lg mb-2">Suivi & Ressources</h2>
                <p class="text-gray-600">Suivez votre progression, accédez à des ressources recommandées et collaborez en temps réel.</p>
            </div>
        </div>
    </main>
    <footer class="text-center text-gray-500 py-8">
        &copy; {{ date('Y') }} CodeClass. Tous droits réservés.
    </footer>
</body>
</html>