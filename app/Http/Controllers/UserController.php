<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = User::query();
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where('nama', 'like', "%$searchTerm%")
                          ->orWhere('email', 'like', "%$searchTerm%")
                          ->orWhere('role', 'like', "%$searchTerm%")
                          ->orWhere('created_at', 'like', "%$searchTerm%");
                }
            
                return response()->json($query->paginate($perPage));
            }

            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);

            return response()->json('Berhasil Membuat Data');
        }

        $data = [
            'title' => 'Data User'
        ];
        return view('page.dashboard.user', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!User::find($id)) {
                return response()->json('User not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(User::find($id));
            }
    
            $User = User::find($id);
            $User->update($request->only('nama', 'email', 'role'));

            return response()->json('Berhasil update User');
        }
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus User');
    }
}
