<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\CommunityMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    /**
     * Display a listing of communities.
     */
    public function index()
    {
        $communities = Community::all();
        
        // Get some random users for display purposes
        $randomUsers = User::inRandomOrder()->limit(20)->get();
        
        return view('community', compact('communities', 'randomUsers'));
    }

    /**
     * Join a community.
     */
    public function join(Request $request)
    {
        $validated = $request->validate([
            'community_id' => 'required|exists:communities,id',
        ]);
        
        $user = Auth::user();
        $community = Community::findOrFail($validated['community_id']);
        
        // Check if user is already a member
        if (!$community->isMember($user->id)) {
            // Create new membership
            CommunityMember::create([
                'user_id' => $user->id,
                'community_id' => $community->id,
                'joined_at' => now(),
            ]);
            
            // Increment member count
            $community->increment('member_count');
            
            return redirect()->back()->with('success', 'You have successfully joined the community!');
        }
        
        return redirect()->back()->with('info', 'You are already a member of this community.');
    }

    /**
     * Leave a community.
     */
    public function leave(Request $request)
    {
        $validated = $request->validate([
            'community_id' => 'required|exists:communities,id',
        ]);
        
        $user = Auth::user();
        $community = Community::findOrFail($validated['community_id']);
        
        // Check if user is a member
        if ($community->isMember($user->id)) {
            // Delete membership
            CommunityMember::where('user_id', $user->id)
                ->where('community_id', $community->id)
                ->delete();
            
            // Decrement member count
            $community->decrement('member_count');
            
            return redirect()->back()->with('success', 'You have left the community.');
        }
        
        return redirect()->back()->with('info', 'You are not a member of this community.');
    }
}