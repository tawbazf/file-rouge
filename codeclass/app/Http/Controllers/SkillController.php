<?php

namespace App\Http\Controllers;

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
}
