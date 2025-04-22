<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DroitController extends Controller
{
    public function updateUserRights(Request $request)
{
    if (Auth::user()->role !== 'teacher') {
        return redirect()->route('dashboard')->with('error', 'Accès refusé.');
    }

    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required|in:teacher,user',
        'permissions' => 'nullable|array',
    ]);

    $user = User::findOrFail($request->user_id);
    $user->role = $request->role;
    if ($request->has('permissions')) {
        $user->permissions = json_encode($request->permissions);
    }
    $user->save();

    return redirect()->route('dashboardProf')->with('success', 'Droits mis à jour avec succès.');
}
}