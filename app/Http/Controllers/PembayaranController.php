<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
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
            Pembayaran::create([
                'id_tim'=> $request->id_tim,
                'total_pembayaran'=> $request->total_pembayaran,
                'status_pembayaran'=> $request->status_pembayaran,
            ]);

            return $this->jsonResponse('Berhasil Membuat Data', '', 200);
        }

        $data = [
            'title' => 'Data Pembayaran'
        ];
        return view('', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Pembayaran::find($id)) {
                return $this->jsonResponse('Pembayaran not found.', '', 404);
            }
    
            if ($request->isMethod('get')) {
                return $this->jsonResponse('Success retrieve data', Pembayaran::find($id), 200);
            }
    
            $Pembayaran = Pembayaran::find($id);
            $Pembayaran->update($request->all());

            return $this->jsonResponse('Berhasil update Pembayaran', '', 200);
        }
    }

    public function delete($id)
    {
        $data = Pembayaran::findOrFail($id);
        $data->destroy();
        return $this->jsonResponse('Berhasil hapus Pembayaran', '', 200);
    }
}
