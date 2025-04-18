<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

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
}