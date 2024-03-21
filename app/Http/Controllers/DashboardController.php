<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'user' => User::count(),
            'tim' => Tim::count(),
            'atlit' => Atlet::count(),
        ];
        return view('page.dashboard.index', compact('data'));
    }

    public function Profile(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                return response()->json(User::findOrFail($id));
            }

            $user = User::find($id);
            $user->update($request->only(['nama', 'email']));

            return response()->json('Berhasil update profile');
        }

        $data = [
            'title' => 'Profile',
        ];

        return view('page.dashboard.profile', compact('data'));
    }

    public function changePassword(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = User::find($id);
    
            if (!$user) {
                return response()->json('User not found', 404);
            }

            $currentPassword = $request->input('password_lama');
            $newPassword = $request->input('password_baru');
            $konfirmasiPassword = $request->input('password_baru_konfirmasi');

            if ($newPassword !== $konfirmasiPassword) {
                return response()->json('Konfirmasi password tidak sama!');
            }
    
            if (Hash::check($currentPassword, $user->password)) {
                $user->password = bcrypt($newPassword);
                $user->save();
    
                return response()->json('Berhasil update password');
            } else {
                return response()->json('Password salah!');
            }
        }

        $data = [
            'title' => 'Ganti Password',
        ];

        return view('page.dashboard.changepassword', compact('data'));
    }
}
