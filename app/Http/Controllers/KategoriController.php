<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = Kategori::query();
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where('nama_kategori', 'like', "%$searchTerm%")
                          ->orWhere('created_at', 'like', "%$searchTerm%");
                }
            
                return response()->json($query->paginate($perPage));
            }

            Kategori::create([
                'nama_kategori'=> $request->nama_kategori,
            ]);

            return response()->json('Berhasil Membuat Data');
        }

        $data = [
            'title' => 'Data Kategori'
        ];
        return view('page.dashboard.kategori', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Kategori::find($id)) {
                return response()->json('kategori not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(Kategori::find($id));
            }
    
            $kategori = Kategori::find($id);
            $kategori->update($request->only('nama_kategori'));

            return response()->json('Berhasil update kategori');
        }
    }

    public function delete($id)
    {
        $data = Kategori::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus kategori');
    }
}