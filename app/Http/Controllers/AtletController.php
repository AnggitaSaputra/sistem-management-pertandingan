<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atlet;

class AtletController extends Controller
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
            Atlet::create([
                'nama'=> $request->nama,
                'ttl'=> $request->ttl,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'berat_badan'=> $request->berat_badan,
                'foto'=> $request->foto,
                'foto_ktp'=> $request->foto_ktp,
                'ijazah_karate'=> $request->ijazah_karate,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data', '', 200);
        }

        $data = [
            'title' => 'Data Atlet'
        ];
        return view('', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Atlet::find($id)) {
                return $this->jsonResponse('Atlet not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', Atlet::find($id), 200);
            }
    
            $Atlet = Atlet::find($id);
            $Atlet->update($request->all());

            return $this->jsonResponse('Berhasil update atlet', '', 200);
        }
    }

    public function delete($id)
    {
        $data = Atlet::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus atlet', '', 200);
    }
}
