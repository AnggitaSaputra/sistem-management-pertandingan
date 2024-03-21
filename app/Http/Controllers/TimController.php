<?php

namespace App\Http\Controllers;

use App\Models\ListTimJadwalPertandingan;
use App\Models\Tim;
use App\Models\TimListUser;
use Illuminate\Http\Request;

class TimController extends Controller
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
            Tim::create([
                'nama_tim'=> $request->nama_tim,
                'asal_institusi'=> $request->asal_institusi,
                'email'=> $request->email,
                'alamat'=> $request->alamat,
                'manager'=> $request->manager,
                'no_hp'=> $request->no_hp,
                'foto_tim'=> $request->foto_tim,
                'surat_tugas'=> $request->surat_tugas,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data', '', 200);
        }

        $data = [
            'title' => 'Data Tim'
        ];
        return view('', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Tim::find($id)) {
                return $this->jsonResponse('Tim not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', Tim::find($id), 200);
            }
    
            $Tim = Tim::find($id);
            $Tim->update($request->all());

            return $this->jsonResponse('Berhasil update Tim', '', 200);
        }
    }

    public function delete($id)
    {
        $data = Tim::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus Tim', '', 200);
    }

    public function list(Request $request) 
    {
        if ($request->ajax()) {
            TimListUser::create([
                'id_tim'=> $request->id_tim,
                'id_user'=> $request->id_user,
                'role'=> $request->role,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data List Tim', '', 200);
        }

        $data = [
            'title' => 'Data List Tim'
        ];
        return view('', compact('data'));
    }

    public function updateList(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!TimListUser::find($id)) {
                return $this->jsonResponse('Tim not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', Tim::find($id), 200);
            }
    
            $Tim = TimListUser::find($id);
            $Tim->update($request->all());

            return $this->jsonResponse('Berhasil update Tim', '', 200);
        }
    }

    public function deleteList($id)
    {
        $data = TimListUser::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus Tim', '', 200);
    }
}
