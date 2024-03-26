<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                return response()->json(Notifikasi::all());
            }

            $id = $request->id;
            $notifikasi = Notifikasi::where('id_user', Auth::user()->id)->findOrFail($id);
            $notifikasi->update($request->only('read'), 'read');
        }
    }
}
