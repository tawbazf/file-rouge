
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen font-sans text-gray-800">
    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-4xl font-extrabold text-indigo-700">Mes Projets</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progression</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($projects as $project)
                    <tr class="hover:bg-gray-50 transition" id="project-row-{{ $project->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $project->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 mr-2 status-display">
                                    {{ $project->status }}
                                </span>
                                <button onclick="toggleEditStatus({{ $project->id }})" class="text-gray-500 hover:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <div class="hidden status-edit-form ml-2">
                                    <form action="{{ route('projects.update-status', $project->id) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="border rounded text-sm px-2 py-1">
                                            <option value="not_started" {{ $project->status == 'not_started' ? 'selected' : '' }}>Non commencé</option>
                                            <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                                            <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Terminé</option>
                                        </select>
                                        <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-xs ml-1">
                                            Enregistrer
                                        </button>
                                        <button type="button" onclick="toggleEditStatus({{ $project->id }})" class="bg-gray-300 text-gray-700 px-2 py-1 rounded text-xs ml-1">
                                            Annuler
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center">
                                <div class="w-40 bg-gray-200 rounded-full h-2 mr-2 progress-display">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $project->progress }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500 progress-value">{{ $project->progress }}%</span>
                                <button onclick="toggleEditProgress({{ $project->id }})" class="text-gray-500 hover:text-indigo-600 ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <div class="hidden progress-edit-form ml-2">
                                    <form action="{{ route('projects.update-progress', $project->id) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="progress" min="0" max="100" value="{{ $project->progress }}" class="border rounded text-sm px-2 py-1 w-16">
                                        <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-xs ml-1">
                                            Enregistrer
                                        </button>
                                        <button type="button" onclick="toggleEditProgress({{ $project->id }})" class="bg-gray-300 text-gray-700 px-2 py-1 rounded text-xs ml-1">
                                            Annuler
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <a href="{{ route('projects.show', $project->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Voir</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    @if($projects->isEmpty())
    <div class="text-center text-gray-500 mt-8">
        <p>Aucun projet trouvé.</p>
    </div>
    @endif

    <script>
        function toggleEditStatus(projectId) {
            const row = document.getElementById(`project-row-${projectId}`);
            const statusDisplay = row.querySelector('.status-display');
            const statusEditForm = row.querySelector('.status-edit-form');
            
            statusDisplay.classList.toggle('hidden');
            statusEditForm.classList.toggle('hidden');
        }
        
        function toggleEditProgress(projectId) {
            const row = document.getElementById(`project-row-${projectId}`);
            const progressDisplay = row.querySelector('.progress-display');
            const progressValue = row.querySelector('.progress-value');
            const progressEditForm = row.querySelector('.progress-edit-form');
            
            progressDisplay.classList.toggle('hidden');
            progressValue.classList.toggle('hidden');
            progressEditForm.classList.toggle('hidden');
        }
    </script>
</body>
</html>
