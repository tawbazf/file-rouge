@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le Projet</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre du Projet</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $project->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ $project->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select" required>
                <option value="not_started" {{ $project->status === 'not_started' ? 'selected' : '' }}>Non commencé</option>
                <option value="in_progress" {{ $project->status === 'in_progress' ? 'selected' : '' }}>En cours</option>
                <option value="completed" {{ $project->status === 'completed' ? 'selected' : '' }}>Terminé</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="progress" class="form-label">Progression (%)</label>
            <input type="number" name="progress" id="progress" class="form-control" min="0" max="100" value="{{ $project->progress }}" required>
        </div>

        <div class="mb-3">
            <label for="time_remaining" class="form-label">Temps Restant</label>
            <input type="text" name="time_remaining" id="time_remaining" class="form-control" value="{{ $project->time_remaining }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection