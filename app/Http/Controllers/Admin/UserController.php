<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUser;
use App\Http\Requests\Admin\User\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->get();
            return ResponseFormatter::success($data, 'Data user berhasil diambil');
        }
        return view('pages.admin.user.index');
    }

    public function store(StoreUser $request)
    {
        try {
            $user = User::create([
                'name' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole($request->role);
            return ResponseFormatter::success($user, 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'User gagal ditambahkan');
        }
    }

    public function update(UpdateUser $request)
    {
        try {
            $user = User::find($request->id);
            $user->update([
                'name' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
            ]);
            if ($request->password) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            $user->syncRoles($request->role);
            return ResponseFormatter::success($user, 'User berhasil diubah');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'User gagal diubah');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->removeRole($user->roles[0]->name);
            $user->delete();
            return ResponseFormatter::success(null, 'User berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'User gagal dihapus');
        }
    }
}
