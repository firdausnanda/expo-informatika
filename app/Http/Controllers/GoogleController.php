<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'username' => explode('@', $googleUser->getEmail())[0],
                    'gauth_id' => $googleUser->getId(),
                    'gauth_type' => 'google',
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt('google123')
                ]
            );

            // Assign admin role if user doesn't have any role
            if (!$user->hasAnyRole()) {
                $adminRole = Role::where('name', 'admin')->first();
                if ($adminRole) {
                    $user->assignRole($adminRole);
                }
            }

            Auth::login($user);

            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
        }
    }
}

{
    //
}
