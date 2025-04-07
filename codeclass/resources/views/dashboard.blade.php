
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeclass - Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <header class="flex items-center justify-between py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-indigo-600">Codeclass</h1>
            <div class="flex items-center">
                <span class="mr-4 text-gray-700">Bonjour, {{ $user->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">Déconnexion</button>
                </form>
            </div>
        </header>

        <!-- Projects Section -->
        <div class="py-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Projets en cours</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <span class="badge-blue px-3 py-1 rounded-full text-xs font-medium">{{ $project['status'] }}</span>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $project['name'] }}</h3>
                        <div class="flex items-center text-gray-500 mb-4">
                            <span class="text-sm">{{ $project['time_remaining'] }} restantes</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill-blue" style="width: {{ $project['progress'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>