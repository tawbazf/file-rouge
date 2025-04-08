@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Créer un Nouveau Projet</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titre du Projet</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Entrez le titre du projet" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Entrez une description (facultatif)"></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select" required>
                <option value="not_started">Non commencé</option>
                <option value="in_progress">En cours</option>
                <option value="completed">Terminé</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="progress" class="form-label">Progression (%)</label>
            <input type="number" name="progress" id="progress" class="form-control" min="0" max="100" value="0" required>
        </div>

        <div class="mb-3">
            <label for="time_remaining" class="form-label">Temps Restant</label>
            <input type="text" name="time_remaining" id="time_remaining" class="form-control" placeholder="Exemple : 2 heures, 3 jours (facultatif)">
        </div>

        <button type="submit" class="btn btn-primary">Créer le Projet</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection