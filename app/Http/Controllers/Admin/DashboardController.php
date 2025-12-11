<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Project & User
        $project = Project::count();
        $user = User::count();

        // Project Week
        $projectweek = Project::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->orderBy('created_at', 'desc')->count();
        $projectliked = Project::has('likers')->count();

        // User Week
        $userweek = User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->orderBy('created_at', 'desc')->count();

        // Project & User Precentage
        $projectprecentage = $project > 0 && $projectweek > 0 ? ($projectweek / $project) * 100 : 0;
        $projectratedprecentage = $project > 0 && $projectliked > 0 ? ($projectliked / $project) * 100 : 0;
        $userprecentage = $user > 0 && $userweek > 0 ? ($userweek / $user) * 100 : 0;

        // Project Chart
        $months = collect(CarbonPeriod::create(
            now()->subMonths(11)->startOfMonth(),
            '1 month',
            now()->endOfMonth()
        ))->map(function (Carbon $date): array {
            return [
                'key' => $date->format('Y-m'),
                'label' => $date->translatedFormat('F Y'),
            ];
        });        

        $projects = Project::selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as month,
                COUNT(*) as count")
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->pluck('count', 'month');

        // Gabungkan data
        $chartData = $months->map(function ($month) use ($projects) {
            return [
                'label' => $month['label'],
                'count' => $projects[$month['key']] ?? 0
            ];
        });

        return view('pages.admin.dashboard.index', compact('project', 'user', 'projectweek', 'projectliked', 'projectprecentage', 'projectratedprecentage', 'userprecentage', 'chartData'));
    }

    public function projectRated()
    {
        $projects = Project::with([
            'matakuliah',
            'lastLike' => fn($q) => $q->with('user')->latest()
        ])
            ->where('status', 1)
            ->withCount('likers')
            ->has('likers')
            ->orderBy('likers_count', 'desc')
            ->take(100)
            ->get();

        return ResponseFormatter::success(
            $projects,
            'Data berhasil diambil'
        );
    }
}
