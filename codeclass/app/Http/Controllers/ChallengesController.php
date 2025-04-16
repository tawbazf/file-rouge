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
        $challenges = Challenge::where('user_id', $user->id)->paginate(10);
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
}