<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $project = Project::find($request->id);
        $user->like($project);

        return ResponseFormatter::success([
            'user' => $user,
            'project' => $project
        ], 'Proyek berhasil disukai');

    }
}
