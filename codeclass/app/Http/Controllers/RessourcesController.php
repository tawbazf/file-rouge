<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;
use Illuminate\Support\Facades\Auth;

class RessourcesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ressources = Ressource::where('user_id', $user->id)->paginate(10);
        return view('ressources', compact('ressources'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required|url',
        ]);
        $ressource = new Ressource();
        $ressource->user_id = $user->id;
        $ressource->title = $request->title;
        $ressource->description = $request->description;
        $ressource->url = $request->url;
        $ressource->save();

        return redirect()->route('ressources')->with('success', 'Ressource ajoutée !');
    }
}