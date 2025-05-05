<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $communities = Community::where('user_id', $user->id)->paginate(10);
        return view('community', compact('communities'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);
        $community = new Community();
        $community->user_id = $user->id;
        $community->title = $request->title;
        $community->message = $request->message;
        $community->save();

        return redirect()->route('community')->with('success', 'Message added!');
    }

    public function join(Request $request)
    {
        $validated = $request->validate([
            'community_id' => 'required|exists:communities,id',
        ]);
        $existingMembership = CommunityMember::where('user_id', auth()->id())
            ->where('community_id', $validated['community_id'])
            ->first();
            
        if (!$existingMembership) {
            CommunityMember::create([
                'user_id' => auth()->id(),
                'community_id' => $validated['community_id'],
                'joined_at' => now(),
            ]);
            
            return redirect()->back()->with('success', 'You have successfully joined the community!');
        }
        
        return redirect()->back()->with('info', 'You are already a member of this community.');
    }

}