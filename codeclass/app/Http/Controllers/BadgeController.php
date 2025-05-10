<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;
use App\Models\User;

class BadgeController extends Controller
{
    // Show the badge creation form (teachers only)
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Access denied. Only teachers can create badges.');
        }
        return view('badge');
    }

    // Store a new badge
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'teacher') {
            return $request->expectsJson()
                ? response()->json(['error' => 'Access denied. Only teachers can create badges.'], 403)
                : redirect()->route('dashboard')->with('error', 'Access denied. Only teachers can create badges.');
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
            'color' => 'required|string|in:blue,green,purple,red',
        ]);

        try {
            $badge = new Badge();
            $badge->name = $validated['name'];
            $badge->description = $validated['description'];
            $badge->category = $validated['category'];
            $badge->level = $validated['level'];
            $badge->color = $validated['color'];
            $badge->points = $validated['points'];
            $badge->points_required = $validated['points_required'];
            $badge->min_points = $validated['min_points'];
            $badge->min_activity_hours = $validated['min_activity_hours'];
            $badge->time = $validated['time'];
            $badge->projects = $validated['projects'];
            $badge->image = $this->generateBadgeImage($validated['color'], $validated['level']);
            $badge->created_by = auth()->id();
            $badge->save();

            if ($request->expectsJson()) {
                return response()->json(['success' => 'Badge créé avec succès!']);
            }

            return redirect()->route('badges.index')->with('success', 'Badge créé avec succès!');
        } catch (\Exception $e) {
            \Log::error('Badge creation error: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json(['error' => 'Une erreur est survenue. Veuillez réessayer.'], 500);
            }

            return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.')->withInput();
        }
    }

    // List badges based on user role
    public function index()
    {
        $user = auth()->user();
        if ($user && $user->role === 'teacher') {
            $badges = Badge::all();
            return view('badge', compact('badges'));
        } else {
            $badges = $user ? $user->badges()->withPivot('awarded_at')->get() : collect([]);
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
        $userPoints = $user->points ?? 0;
        $userTime = $user->active_hours ?? 0;

        return $completedProjects >= $badge->projects &&
               $userPoints >= $badge->points_required &&
               $userTime >= $badge->time;
    }

    // Generate badge image
    protected function generateBadgeImage($color, $level)
    {
        $colorMap = [
            'blue' => '3b82f6',
            'green' => '10b981',
            'purple' => '8b5cf6',
            'red' => 'ef4444',
        ];
        $hexColor = $colorMap[$color] ?? '3b82f6';
        return "badges/{$level}-{$hexColor}.png";
    }

    // For testing badge assignment
    public function checkAndAssignBadges(Request $request)
    {
        $user = auth()->user();
        $this->assignBadgeIfEligible($user);
        return redirect()->back()->with('success', 'Badges vérifiés et attribués si éligible.');
    }
}