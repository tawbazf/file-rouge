<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleSelectionController extends Controller
{
// Affiche la page de sélection de rôle
public function show()
{
return view('choose-role');
}

// Gère la soumission du rôle sélectionné
public function store(Request $request)
{
$request->validate([
'role' => 'required|in:user,teacher',
]);

// Met à jour le rôle de l'utilisateur connecté
$user = Auth::user();
$user->role = $request->role;
$user->save();

// Redirige vers le tableau de bord approprié
if ($request->role === 'user') {
return redirect()->route('dashboard');
} elseif ($request->role === 'teacher') {
return redirect()->route('dashboardProf');
}
}
}