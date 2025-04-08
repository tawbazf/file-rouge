<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadgeController extends Controller
{
    // Display the badge creation form
    public function create()
    {
        return view('badge');
    }

    // Handle badge creation form submission
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'points' => 'required|integer|min:0',
            'time' => 'required|integer|min:0',
            'projects' => 'required|integer|min:0',
        ]);

        // Save the badge to the database (assuming you have a `badges` table)
        \App\Models\Badge::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'points' => $request->points,
            'time' => $request->time,
            'projects' => $request->projects,
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('badge.create')->with('success', 'Badge created successfully!');
    }
}