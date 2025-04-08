<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Carbon\Carbon;

class NotificationController extends Controller
{
    // Notifications pour les étudiants
    public function studentNotifications()
    {
        $notifications = [];

        // Récupérer les projets dont la date limite est dans les prochaines 24 heures
        $projectsDueSoon = Project::where('deadline', '<=', Carbon::now()->addDay())->get();
        foreach ($projectsDueSoon as $project) {
            $notifications[] = [
                'type'    => 'urgent',
                'title'   => "Échéance Projet: {$project->title}",
                'message' => "Le projet \"{$project->title}\" doit être livré avant " . Carbon::parse($project->deadline)->format('H:i d/m/Y') . ".",
                'time'    => Carbon::parse($project->deadline)->diffForHumans(),
            ];
        }

        // Récupérer les projets approuvés
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

    // Notifications pour les enseignants
    public function teacherNotifications()
    {
        $notifications = [];

        // Récupérer les projets qui ont eu de nouvelles collaborations dans les 4 dernières heures
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

        // Ajouter un rappel fixe pour une réunion hebdomadaire (vous pouvez aussi le rendre dynamique)
        $notifications[] = [
            'type'    => 'warning',
            'title'   => 'Rappel: Réunion',
            'message' => 'Réunion d\'équipe hebdomadaire dans 30 minutes.',
            'time'    => 'Il y a 4 heures', // ou utilisez Carbon pour générer une valeur dynamique
        ];

        return view('centre-notifications', compact('notifications'));
    }
}