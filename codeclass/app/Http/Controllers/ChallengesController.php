<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;

class ChallengesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $challenges = Challenge::paginate(10);
        return view('challenges', compact('challenges'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);
        $challenge = new Challenge();
        $challenge->user_id = $user->id;
        $challenge->title = $request->title;
        $challenge->date = $request->date;
        $challenge->status = $request->status;
        $challenge->save();

        return redirect()->route('challenges')->with('success', 'Challenge added!');
    }
    public function participate(Request $request, $id)
    {
        $user = Auth::user();
        $challenge = Challenge::findOrFail($id);
        
        // Vérifier si l'utilisateur participe déjà
        if ($challenge->hasParticipant($user->id)) {
            return redirect()->route('challenges')->with('info', 'Vous participez déjà à ce challenge!');
        }
        
        // Ajouter l'utilisateur comme participant
        $challenge->participants()->attach($user->id, [
            'status' => 'not_started',
            'joined_at' => now()
        ]);
        
        return redirect()->route('challenges')->with('success', 'Vous participez maintenant au challenge!');
    }
    
    // Méthode pour mettre à jour le statut de participation
    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();
        $challenge = Challenge::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:not_started,in_progress,completed',
        ]);
        
        // Vérifier si l'utilisateur participe au challenge
        if (!$challenge->hasParticipant($user->id)) {
            return redirect()->route('challenges')->with('error', 'Vous ne participez pas à ce challenge!');
        }
        
        // Mettre à jour le statut
        $challenge->participants()->updateExistingPivot($user->id, [
            'status' => $request->status
        ]);
        
        return redirect()->route('challenges')->with('success', 'Statut du challenge mis à jour!');
    }

}