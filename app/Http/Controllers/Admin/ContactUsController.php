<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactUs::take(100)->withCount('views')->orderBy('views_count', 'asc')->get();
            return ResponseFormatter::success($data, 'Data Contact Us');
        }
        return view('pages.admin.contact-us.index');
    }

    public function view($id)
    {
        $data = ContactUs::find($id);

        $cookieName = 'viewed_' . $data->id;

        if (!request()->cookie($cookieName)) {
            views($data)->record();
            return response()->json($data)
                ->withCookie($cookieName, true, 60 * 24);
        }
        return ResponseFormatter::success($data, 'Data Contact Us');
    }
}
