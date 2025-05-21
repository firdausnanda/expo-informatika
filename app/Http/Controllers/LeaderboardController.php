<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Like;

class LeaderboardController extends Controller
{
    public function index()
    {
        $projects = Project::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->paginate(12);
            
        return view('pages.leaderboard', compact('projects'));
    }
} 