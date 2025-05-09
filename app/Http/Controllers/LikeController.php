<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {

        if (!Auth::check()) {
            return ResponseFormatter::error([
                'message' => 'User not authenticated'
            ], 'User not authenticated', 401);
        }

        $user = User::find(auth()->user()->id);
        $project = Project::find($request->id);

        if ($user->hasLiked($project)) {
            $user->unlike($project);
            return ResponseFormatter::success([
                'user' => $user,
                'liked' => false,
                'project' => $project
            ], 'Proyek berhasil dihapus dari daftar suka');
        } else {
            $user->like($project);
            return ResponseFormatter::success([
                'user' => $user,
                'liked' => true,
                'project' => $project
            ], 'Proyek berhasil disukai');
        }
    }
}
