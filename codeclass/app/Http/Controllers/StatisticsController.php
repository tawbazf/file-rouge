<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index()
    {
        // Exemple de données pour les statistiques générales
        $classAverage = 15.8;
        $activeStudents = 28;
        $totalStudents = 30;
        $homeworkCompletion = 92; // En pourcentage
        $globalProgress = 78; // En pourcentage

        // Liste des étudiants avec leurs informations
        $students = [
            [
                'id' => '2025001',
                'name' => 'Emma Bernard',
                'avatar' => 'https://randomuser.me/api/portraits/women/32.jpg',
                'average' => 17.5,
                'progress' => 85,
                'lastActivity' => 'Il y a 2 heures',
            ],
            [
                'id' => '2025002',
                'name' => 'Lucas Martin',
                'avatar' => 'https://randomuser.me/api/portraits/men/45.jpg',
                'average' => 14.8,
                'progress' => 70,
                'lastActivity' => 'Hier',
            ],
        ];

        // Passer les données à la vue
        return view('general-statistics', compact(
            'classAverage',
            'activeStudents',
            'totalStudents',
            'homeworkCompletion',
            'globalProgress',
            'students'
        ));
    }
}