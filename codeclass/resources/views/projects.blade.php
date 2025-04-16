<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets</title>
    <link href="[https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"](https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css") rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-700">Mes Projets</h1>
            
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Nom</th>
                        <th class="px-4 py-2 text-left text-gray-600">Statut</th>
                        <th class="px-4 py-2 text-left text-gray-600">Progression</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
    <tr class="border-b">
        <td class="px-4 py-2">{{ $project->name }}</td>
        <td class="px-4 py-2">
            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">{{ $project->status }}</span>
        </td>
        <td class="px-4 py-2">
            <div class="w-32 bg-gray-200 rounded-full h-2">
                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $project->progress }}%"></div>
            </div>
            <span class="text-xs text-gray-500 ml-2">{{ $project->progress }}%</span>
        </td>
        <td class="px-4 py-2 text-right">
            <a href="#" class="text-indigo-600 hover:underline text-sm">Voir</a>
        </td>
    </tr>
@endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>