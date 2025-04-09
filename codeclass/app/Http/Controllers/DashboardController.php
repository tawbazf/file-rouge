<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Get projects associated with the authenticated user
        $projects = Project::where('user_id', $user->id)->get();

        // Return a view with the user and projects data
        return view('dashboard', compact('user', 'projects'));
    }
}