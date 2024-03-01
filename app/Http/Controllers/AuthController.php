<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Auth::attempt($request->only('email', 'password'))
                ? response()->json(['message' => 'Login successful', 'redirect' => 'dashboard'], 200)
                : response()->json(['message' => 'Invalid credentials'], 401);
        } else {
            $data = [
                'title' => 'Login'
                ];
            return view('page.auth.login', compact('data'));
        }
        }

    public function register(Request $request)
    {
        if ($request->ajax()) {
            $registerUser = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role
            ]);
            if ($registerUser) {
                response()->json(['message' => 'berhasil daftar'], 200);
            } else {
                response()->json(['message' => 'Invalid credentials'], 401);
            }
        }
        $data = [
            'title' => 'Register'
        ];
        return view('page.auth.register', compact('data'));
    }
}
