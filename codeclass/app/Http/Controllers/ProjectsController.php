<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\CodeFile;
use Illuminate\Support\Facades\Http;


class ProjectsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $projects = Project::where('teacher_id', $user->id)->get();
        return view('projects', compact('projects'));
    }
    public function complete(Request $request, Project $project)
    {
        $user = auth()->user();
        $user->assignedProjects()->updateExistingPivot($project->id, ['status' => 'completed']);

        // Check and assign badges
        $badgeController = new BadgeController();
        $badgeController->assignBadgeIfEligible($user);

        return redirect()->back()->with('success', 'Projet complété !');
    }
 

public function codeReview($fileId = null)
{
    $files = CodeFile::all();
    $selectedFile = $fileId ? CodeFile::findOrFail($fileId) : $files->first();

    $comments = $selectedFile ? $selectedFile->lineComments()->with('user')->get() : collect();
    return view('codereview', compact('files', 'selectedFile', 'comments'));
}



public function store(Request $request)
{
    
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'nullable|string',
        'progress' => 'nullable|numeric|min:0|max:100',
        'time_remaining' => 'nullable|string|max:255',
    ]);

   
    $project = new Project();
    $project->title = $validated['title'];
    $project->description = $validated['description'] ?? null;
    $project->status = $validated['status'] ?? 'not_started';
    $project->progress = $validated['progress'] ?? 0;
    $project->time_remaining = $validated['time_remaining'] ?? null;
    $project->teacher_id = auth()->id();
    $project->save();


    return redirect()->route('dashboardProf')->with('success', 'Projet créé avec succès!');
}
public function updateStatus(Request $request, $projectId)
{
    $project = Project::findOrFail($projectId);
    
   
    
    $validated = $request->validate([
        'status' => 'required|in:not_started,in_progress,completed',
    ]);
    
    $project->status = $validated['status'];
    $project->save();
    
    return redirect()->back()->with('success', 'Statut du projet mis à jour avec succès.');
}

public function updateProgress(Request $request, $projectId)
{
    $project = Project::findOrFail($projectId);
    
    
    
    $validated = $request->validate([
        'progress' => 'required|integer|min:0|max:100',
    ]);
    
    $project->progress = $validated['progress'];
    $project->save();
    
    return redirect()->back()->with('success', 'Progression du projet mise à jour avec succès.');
}

}