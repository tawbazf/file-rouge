@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Projets</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Créer un Projet</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Progression</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</td>
                    <td>{{ $project->progress }}%</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection