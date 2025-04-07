<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardProfController extends Controller
{
    public function index()
    {
        // Vérifier si l'utilisateur est un professeur
        $user = Auth::user();
        if ($user->role !== 'teacher') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        // Exemple de données spécifiques aux professeurs
        $projects = [
            ['name' => 'Projet Web Full-Stack', 'status' => 'En cours', 'deadline' => '15 Mai 2025', 'students' => 3],
            ['name' => 'API REST', 'status' => 'À venir', 'deadline' => '30 Mai 2025', 'students' => 2],
            ['name' => 'Base de Données NoSQL', 'status' => 'Urgent', 'deadline' => '10 Mai 2025', 'students' => 4],
        ];

        // Retourner la vue avec les données
        return view('dashboardProf', compact('user', 'projects'));
    }
}