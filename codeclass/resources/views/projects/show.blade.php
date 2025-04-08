@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Détails du Projet</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">{{ $project->title }}</h2>
            <p class="card-text"><strong>Description :</strong> {{ $project->description ?? 'Aucune description disponible.' }}</p>
            <p class="card-text"><strong>Statut :</strong> 
                @if ($project->status === 'not_started')
                    Non commencé
                @elseif ($project->status === 'in_progress')
                    En cours
                @elseif ($project->status === 'completed')
                    Terminé
                @endif
            </p>
            <p class="card-text"><strong>Progression :</strong> {{ $project->progress }}%</p>
            <p class="card-text"><strong>Temps Restant :</strong> {{ $project->time_remaining ?? 'Non spécifié' }}</p>
        </div>
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Retour à la liste des projets</a>
    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">Modifier le Projet</a>
    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer le Projet</button>
    </form>
</div>
@endsection