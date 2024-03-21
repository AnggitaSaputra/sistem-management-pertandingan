<?php

namespace App\Http\Controllers;

use App\Models\JadwalPertandingan;
use App\Models\ListTimJadwalPertandingan;
use Illuminate\Http\Request;

class JadwalPertandinganController extends Controller
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
            JadwalPertandingan::create([
                'nama_pertandingan'=> $request->nama_pertandingan,
                'waktu_mulai_pertandingan'=> $request->waktu_mulai_pertandingan,
                'waktu_akhir_pertandingan'=> $request->waktu_akhir_pertandingan,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data', '', 200);
        }

        $data = [
            'title' => 'Data JadwalPertandingan'
        ];
        return view('', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!JadwalPertandingan::find($id)) {
                return $this->jsonResponse('JadwalPertandingan not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', JadwalPertandingan::find($id), 200);
            }
    
            $JadwalPertandingan = JadwalPertandingan::find($id);
            $JadwalPertandingan->update($request->all());

            return $this->jsonResponse('Berhasil update JadwalPertandingan', '', 200);
        }
    }

    public function delete($id)
    {
        $data = JadwalPertandingan::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus JadwalPertandingan', '', 200);
    }

    public function list(Request $request) 
    {
        if ($request->ajax()) {
            ListTimJadwalPertandingan::create([
                'id_pertandingan'=> $request->id_pertandingan,
                'id_tim'=> $request->id_tim,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data List JadwalPertandingan', '', 200);
        }

        $data = [
            'title' => 'Data List JadwalPertandingan'
        ];
        return view('', compact('data'));
    }

    public function updateList(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!ListTimJadwalPertandingan::find($id)) {
                return $this->jsonResponse('JadwalPertandingan not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', JadwalPertandingan::find($id), 200);
            }
    
            $JadwalPertandingan = ListTimJadwalPertandingan::find($id);
            $JadwalPertandingan->update($request->all());

            return $this->jsonResponse('Berhasil update JadwalPertandingan', '', 200);
        }
    }

    public function deleteList($id)
    {
        $data = ListTimJadwalPertandingan::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus JadwalPertandingan', '', 200);
    }
}
