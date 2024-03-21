<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private function jsonResponse($message, $data = null, $status)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function index(Request $request) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                return response()->json(User::all());
            }

            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data', '', 200);
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
                return $this->jsonResponse('User not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', User::find($id), 200);
            }
    
            $User = User::find($id);
            $User->update($request->all());

            return $this->jsonResponse('Berhasil update User', '', 200);
        }
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus User', '', 200);
    }
}
