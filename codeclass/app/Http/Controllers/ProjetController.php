<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjetController extends Controller
{
    // Afficher la liste des projets
    public function index()
    {
        $projects = Project::all(); // Récupérer tous les projets
        return view('projects.index', compact('projects'));
    }

    // Afficher le formulaire de création de projet
    public function create()
    {
        return view('projects.create');
    }

    // Enregistrer un nouveau projet
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:not_started,in_progress,completed',
            'progress' => 'required|integer|min:0|max:100',
            'time_remaining' => 'nullable|string',
        ]);

    
    $data = $request->all();
    $data['teacher_id'] = auth()->id();

    Project::create($data);

        return redirect()->route('dashboardProf')->with('success', 'Projet créé avec succès.');
    }

    // Afficher un projet spécifique
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    // Afficher le formulaire d'édition d'un projet
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    // Mettre à jour un projet
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:not_started,in_progress,completed',
            'progress' => 'required|integer|min:0|max:100',
            'time_remaining' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès.');
    }

    // Supprimer un projet
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
    }
}