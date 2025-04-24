<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\CodeFile;

class ProjectsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $projects = Project::where('user_id', $user->id)->get();
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
}