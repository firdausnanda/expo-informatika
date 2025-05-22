<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
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
        $projectprecentage = ($projectweek / $project) * 100;
        $projectratedprecentage = ($projectliked / $project) * 100;
        $userprecentage = ($userweek / $user) * 100;

        // Project Chart
        $months = collect(CarbonPeriod::create(
            now()->subMonths(11)->startOfMonth(),
            '1 month',
            now()->endOfMonth()
        ))->map(function ($date) {
            return [
                'key' => $date->format('Y-m'),
                'label' => $date->translatedFormat('F Y') // "Januari 2023"
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
}
