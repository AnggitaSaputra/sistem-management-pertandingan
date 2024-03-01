<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('page.dashboard.index', compact('data'));
    }
    public function logout()
    {
        Auth::logout();
        response()->json(['success'=> true, 'message' => 'berhasil logout'], 200);
    }
}
