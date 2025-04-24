<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;

class CertificationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $certifications = Certification::paginate(10); // 10 per page, adjust as needed
        return view('certifications', compact('certifications'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'badge' => 'required',
        ]);
        $certification = new Certification();
        $certification->user_id = $user->id;
        $certification->title = $request->title;
        $certification->date = $request->date;
        $certification->badge = $request->badge;
        $certification->save();
        return redirect()->route('certifications.index');
    }
}