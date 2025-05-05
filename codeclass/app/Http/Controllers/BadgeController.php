<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;
use App\Models\User;

class BadgeController extends Controller
{
    // Show the badge creation form
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Access denied. Only teachers can create badges.');
        }
        return view('badge');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Access denied. Only teachers can create badges.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'level' => 'required|string|in:Bronze,Argent,Or',
            'points' => 'required|integer|min:0',
            'points_required' => 'required|integer|min:0',
            'min_points' => 'required|integer|min:0',
            'min_activity_hours' => 'required|integer|min:0',
            'time' => 'required|integer|min:0',
            'projects' => 'required|integer|min:0',
            'color' => 'required|string',
        ]);
        try {
            $badge = new Badge();
            $badge->name = $validated['name'];
            $badge->description = $validated['description'];
            $badge->category = $validated['category'];
            $badge->level = $validated['level'];
            $badge->color = $validated['color'];
            $badge->points = $validated['points'];
            $badge->min_points = $validated['min_points'];
            $badge->min_activity_hours = $validated['min_activity_hours'];
            $badge->created_by = auth()->id();
            $badge->save();
        if ($request->expectsJson()) {
            return response()->json([
                'success' => 'Badge créé avec succès!'
            ]);
        }
        
        return redirect()->route('badges.index')->with('success', 'Badge créé avec succès!');
    } catch (\Exception $e) {
    
        \Log::error('Badge creation error: ' . $e->getMessage());
        
    
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Une erreur est survenue. Veuillez réessayer.'
            ], 500);
        }
        
        return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
    }

    }

    // List all badges
    public function index()
    {
    
             $user = auth()->user();
             $badges = Badge::all();
             if  ($user && $user->role === 'teacher') {
                 return view('badge', compact('badges'));
             } else {
                 return view('MesBadges', compact('badges'));
             }
         } 
        
    

    // Assign badge to eligible users
    public function assignBadgeIfEligible($user)
    {
        $badges = Badge::all();
        foreach ($badges as $badge) {
            if ($this->isUserEligible($user, $badge)) {
                $user->badges()->syncWithoutDetaching([$badge->id => ['awarded_at' => now()]]);
            }
        }
    }

    // Check if user is eligible for a badge
    protected function isUserEligible($user, $badge)
    {
        $completedProjects = $user->assignedProjects()->wherePivot('status', 'completed')->count();
        $userPoints = $user->points ?? 0; // Assume User model has a points attribute
        $userTime = $user->active_hours ?? 0; // Assume User model tracks active hours

        return $completedProjects >= $badge->projects &&
               $userPoints >= $badge->points_required &&
               $userTime >= $badge->time;
    }

    // Generate badge image (placeholder logic)
    protected function generateBadgeImage($color, $level)
    {
        // In a real app, use a library like Intervention Image to generate images
        // For now, return a placeholder path based on color and level
        $colorMap = [
            'blue' => '3b82f6',
            'green' => '10b981',
            'purple' => '8b5cf6',
            'red' => 'ef4444',
        ];
        $hexColor = $colorMap[$color] ?? '3b82f6';
        return "badges/{$level}-{$hexColor}.png";
    }
}