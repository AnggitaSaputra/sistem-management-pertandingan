<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasListUser;
use Illuminate\Http\Request;

class KelasController extends Controller
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
            Kelas::create([
                'nama_kelas'=> $request->nama_kelas,
                'kategori'=> $request->kategori,
                'bb'=> $request->bb,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data', '', 200);
        }

        $data = [
            'title' => 'Data Kelas'
        ];
        return view('', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Kelas::find($id)) {
                return $this->jsonResponse('Kelas not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', Kelas::find($id), 200);
            }
    
            $Kelas = Kelas::find($id);
            $Kelas->update($request->all());

            return $this->jsonResponse('Berhasil update kelas', '', 200);
        }
    }

    public function delete($id)
    {
        $data = Kelas::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus Kelas', '', 200);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            KelasListUser::create([
                'id_kelas'=> $request->id_kelas,
                'id_user'=> $request->id_user,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data', '', 200);
        }

        $data = [
            'title' => 'Data Kelas List User'
        ];
        return view('', compact('data'));
    }

    public function updateList(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!KelasListUser::find($id)) {
                return $this->jsonResponse('Kelas list not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', Kelas::find($id), 200);
            }
    
            $Kelas = KelasListUser::find($id);
            $Kelas->update($request->all());

            return $this->jsonResponse('Berhasil update kelas', '', 200);
        }
    }

    public function deleteList($id)
    {
        $data = KelasListUser::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus Kelas', '', 200);
    }
}
