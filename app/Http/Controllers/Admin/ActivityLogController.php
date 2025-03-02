<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $aktivitas = Activity::with('causer', 'subject')->limit(50)->orderBy('id', 'desc')->get();
            return ResponseFormatter::success($aktivitas, 'Data berhasil diambil');
        }
        return view('pages.admin.activity-log.index');
    }
}
