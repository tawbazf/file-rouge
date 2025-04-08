<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class NotificationController extends Controller
{
    // Notifications for students (already implemented)
    public function studentNotifications()
    {
        $notifications = [];

        // Get projects due in the next 24 hours (example)
        $projectsDueSoon = Project::where('deadline', '<=', Carbon::now()->addDay())->get();
        foreach ($projectsDueSoon as $project) {
            $notifications[] = [
                'type'    => 'urgent',
                'title'   => "Échéance Projet: {$project->title}",
                'message' => "Le projet \"{$project->title}\" doit être livré avant " . Carbon::parse($project->deadline)->format('H:i d/m/Y') . ".",
                'time'    => Carbon::parse($project->deadline)->diffForHumans(),
            ];
        }

        // Get approved projects (example)
        $approvedProjects = Project::where('approved', true)->get();
        foreach ($approvedProjects as $project) {
            $notifications[] = [
                'type'    => 'success',
                'title'   => "Validation Réussie: {$project->title}",
                'message' => "Votre projet \"{$project->title}\" a été approuvé.",
                'time'    => Carbon::now()->diffForHumans(),
            ];
        }

        return view('centre-notifications', compact('notifications'));
    }

    // Notifications for teachers
    public function teacherNotifications()
    {
        $notifications = [];

        // Example: Get projects with recent collaborations in the last 4 hours.
        // (Ensure your "projects" table has a "last_collaboration" column.)
        $projectCollabs = Project::whereNotNull('last_collaboration')
            ->where('last_collaboration', '>=', Carbon::now()->subHours(4))
            ->get();

        foreach ($projectCollabs as $project) {
            $notifications[] = [
                'type'    => 'info',
                'title'   => "Nouvelle Collaboration: {$project->title}",
                'message' => "Un nouveau collaborateur a rejoint votre projet \"{$project->title}\".",
                'time'    => Carbon::parse($project->last_collaboration)->diffForHumans(),
            ];
        }

        // Add a fixed meeting reminder as an example
        $notifications[] = [
            'type'    => 'warning',
            'title'   => 'Rappel: Réunion d’équipe',
            'message' => 'La réunion d’équipe commence dans 30 minutes.',
            'time'    => Carbon::now()->diffForHumans(),
        ];

        return view('centre-notifications', compact('notifications'));
    }
}