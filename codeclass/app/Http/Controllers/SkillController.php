<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function mySkills()
{
    $user = auth()->user();
    return view('skills.dashboard', compact('user'));
} 
public function allSkills()
{
    $users = User::with('skills')->get();
    return view('skills.all_users', compact('users'));
}

public function skillGapsRecommendations()
{
    $user = auth()->user();
    $threshold = 50;

    $allSkills = Skill::all();
    $userSkills = $user->skills()->withPivot('level')->get()->keyBy('id');

    $gaps = [];
    foreach ($allSkills as $skill) {
        $level = $userSkills[$skill->id]->pivot->level ?? 0;
        if ($level < $threshold) {
            // Fetch Udemy course via API
            $response = Http::withBasicAuth(
                config('services.udemy.client_id'),
                config('services.udemy.client_secret')
            )->get('[https://www.udemy.com/api-2.0/courses/', [
                'search' => $skill->name,
                'page_size' => 1
            ]);
            $course = $response->json('results.0');
            $gaps[] = [
                'skill' => $skill,
                'level' => $level,
                'course' => $course
            ];
        }
    }

    return view('skills.gaps_recommendations', compact('gaps', 'user'));
}
}