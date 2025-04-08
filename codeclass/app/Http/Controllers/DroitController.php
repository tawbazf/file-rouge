<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DroitController extends Controller
{
    public function updateUserRights(Request $request, $userId)
    {
        // Vérifier que l'utilisateur connecté est un enseignant
        if (Auth::user()->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Accès refusé.');
        }

        // Valider la requête
        $request->validate([
            'role' => 'required|in:student,teacher,admin',
            'permissions' => 'nullable|array',
        ]);

        // Récupérer l'utilisateur cible
        $user = User::findOrFail($userId);

        // Mettre à jour le rôle
        $user->role = $request->role;

        // Mettre à jour les permissions
        if ($request->has('permissions')) {
            // Option 1 : si vous avez une relation many-to-many avec un modèle Permission
            // $user->permissions()->sync($request->permissions);

            // Option 2 : si vous stockez les permissions en JSON dans la table users
            $user->permissions = json_encode($request->permissions);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Droits mis à jour avec succès.');
    }
}