<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeCollabController extends Controller
{
    public function index()
    {
        // Exemple de données pour la collaboration
        $collaborators = [
            ['name' => 'Sarah Chen', 'avatar' => 'https://randomuser.me/api/portraits/women/32.jpg'],
            ['name' => 'Lucas Martin', 'avatar' => 'https://randomuser.me/api/portraits/men/45.jpg'],
            ['name' => 'Emma Bernard', 'avatar' => 'https://randomuser.me/api/portraits/women/68.jpg'],
        ];

        // Passer les données à la vue
        return view('codecollab', compact('collaborators'));
    }
}