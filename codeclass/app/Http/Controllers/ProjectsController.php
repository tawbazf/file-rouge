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
        $projects = Project::all();
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


public function runCode($fileId)
{
    $file = CodeFile::findOrFail($fileId);

    // Map your language field to JDoodle's language identifiers
    $languageMap = [
        'php' => 'php',
        'python' => 'python3',
        'javascript' => 'nodejs',
        'java' => 'java',
        // add more as needed
    ];
    $lang = $languageMap[$file->language] ?? 'python3';

    $clientId = env('JDOODLE_CLIENT_ID');      // Put your JDoodle client ID in .env
    $clientSecret = env('JDOODLE_CLIENT_SECRET'); // Put your JDoodle client secret in .env

    $response = Http::post('https://api.jdoodle.com/v1/execute', [
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
        'script' => $file->content,
        'language' => $lang,
        'versionIndex' => '0',
    ]);

    if ($response->successful()) {
        return response()->json(['output' => $response['output']]);
    } else {
        return response()->json(['error' => 'Execution failed'], 500);
    }
}
}