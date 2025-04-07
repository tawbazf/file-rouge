<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Exemple de données récupérées de la base de données
        $projects = [
            ['name' => 'Introduction au HTML/CSS', 'status' => 'En cours', 'time_remaining' => '2h', 'progress' => 65],
            ['name' => 'JavaScript Basics', 'status' => 'À débuter', 'time_remaining' => '4h', 'progress' => 0],
            ['name' => 'Responsive Design', 'status' => 'Presque fini', 'time_remaining' => '30min', 'progress' => 90],
        ];

        // Passer les données à la vue
        return view('dashboard', compact('user', 'projects'));
    }
}