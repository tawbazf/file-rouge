@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="mb-6">
        <a href="{{ route('projects') }}" class="text-indigo-600 hover:text-indigo-800">
            <span class="inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Retour aux projets
            </span>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $project->title }}</h1>
        
        <div class="flex items-center mb-6">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                @if($project->status == 'completed') bg-green-100 text-green-800
                @elseif($project->status == 'in_progress') bg-blue-100 text-blue-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ $project->status == 'completed' ? 'Terminé' : ($project->status == 'in_progress' ? 'En cours' : 'Non commencé') }}
            </span>
            
            <div class="ml-6 flex items-center">
                <div class="w-40 bg-gray-200 rounded-full h-2 mr-2">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $project->progress }}%"></div>
                </div>
                <span class="text-sm text-gray-500">{{ $project->progress }}% complété</span>
            </div>
        </div>
        
        @if($project->description)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
            <div class="text-gray-600">
                {!! nl2br(e($project->description)) !!}
            </div>
        </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Détails du projet</h2>
                <ul class="space-y-2">
                    @if($project->deadline)
                    <li class="flex items-start">
                        <span class="text-gray-500 w-32">Date limite:</span>
                        <span>{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</span>
                    </li>
                    @endif
                    @if($project->created_at)
                    <li class="flex items-start">
                        <span class="text-gray-500 w-32">Créé le:</span>
                        <span>{{ $project->created_at->format('d/m/Y') }}</span>
                    </li>
                    @endif
                    @if($project->updated_at)
                    <li class="flex items-start">
                        <span class="text-gray-500 w-32">Dernière mise à jour:</span>
                        <span>{{ $project->updated_at->format('d/m/Y') }}</span>
                    </li>
                    @endif
                </ul>
            </div>
            
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('projects.edit', $project->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Modifier le projet
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
