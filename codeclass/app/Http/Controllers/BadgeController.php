<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;

class BadgeController extends Controller
{
    // Show the badge creation form
    public function create()
    {
        // Only allow teachers to access this page
        if (!Auth::check() || Auth::user()->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Access denied. Only teachers can create badges.');
        }
        return view('badge');
    }

    // Handle form submission and save badge
    public function store(Request $request)
    {
        // Only allow teachers to create badges
        if (!Auth::check() || Auth::user()->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Access denied. Only teachers can create badges.');
        }

        // Validate the request
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string',
            'points'      => 'required|integer|min:0',
            'time'        => 'required|integer|min:0',
            'projects'    => 'required|integer|min:0',
        ]);

        // Save badge
        Badge::create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'category'    => $request->input('category'),
            'points'      => $request->input('points'),
            'time'        => $request->input('time'),
            'projects'    => $request->input('projects'),
        ]);

        return redirect()->route('badge.create')->with('success', 'Badge créé avec succès !');
    }
}