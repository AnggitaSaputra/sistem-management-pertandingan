<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Redis;

class KategoriController extends Controller
{
    private function jsonResponse($message, $data = null, $status)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            Kategori::create([
                'nama_kategori'=> $request->nama_kategori,
            ]);
            
            return $this->jsonResponse('Success', '', 200);
        }
        
        $data = [
            'title' => 'Data Kategori'
        ];
        return view('', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Kategori::find($id)) {
                return $this->jsonResponse('Kategori not found', '', 404); 
            }
            
            if ($request->isMehtod('get')){
                return $this->jsonResponse('Succes retieve data','', 200);
            }

            $Kategori = Kategori::find($id);
            $Kategori->update($request->all());

            return $this->jsonResponse('Berhasil update data', '', 200);
        }
        
    }

    public function delete($id)
    {
        $data = Kategori::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus data', '', 200);
    }
}