<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LandingController extends Controller
{
    public function index()
    {
        return view('pages.landing.index');
    }
}
