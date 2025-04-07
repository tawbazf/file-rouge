<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardProfController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est un professeur
        if ($user->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        return view('dashboardProf', compact('user'));
    }
}