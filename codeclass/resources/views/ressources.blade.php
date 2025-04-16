<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ressources</title>
    <link href="[https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"](https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css") rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-green-700">Ressources Utiles</h1>
            <a href="#" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
                + Ajouter une ressource
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
        @foreach($ressources as $ressource)
    <div class="bg-white rounded-lg shadow p-6 flex flex-col">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $ressource->title }}</h2>
        <p class="text-gray-600 flex-1 mb-4">{{ $ressource->description }}</p>
        <a href="{{ $ressource->url }}" target="_blank" class="text-green-600 hover:underline font-medium">Voir la ressource</a>
    </div>
@endforeach
        </div>
    </div>
</body>
</html>