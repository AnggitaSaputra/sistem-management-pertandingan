<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\JadwalPertandingan;
use App\Models\ListTimJadwalPertandingan;
use App\Models\ListAtletInPertandingan;
use App\Models\Tim;
use Illuminate\Http\Request;

class JadwalPertandinganController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = JadwalPertandingan::query();
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where('nama_pertandingan', 'like', "%$searchTerm%")
                          ->orWhere('waktu_mulai_pertandingan', 'like', "%$searchTerm%")
                          ->orWhere('waktu_akhir_pertandingan', 'like', "%$searchTerm%")
                          ->orWhere('created_at', 'like', "%$searchTerm%");
                }
            
                return response()->json($query->paginate($perPage));
            }

            JadwalPertandingan::create([
                'nama_pertandingan'=> $request->nama_pertandingan,
                'waktu_mulai_pertandingan'=> $request->waktu_mulai_pertandingan,
                'waktu_akhir_pertandingan'=> $request->waktu_akhir_pertandingan,
            ]);

            return response()->json('Berhasil Membuat Data');
        }

        $data = [
            'title' => 'Data Jadwal Pertandingan'
        ];
        return view('page.dashboard.jadwal', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!JadwalPertandingan::find($id)) {
                return response()->json('jadwalPertandingan not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(JadwalPertandingan::find($id));
            }
    
            $jadwalPertandingan = JadwalPertandingan::find($id);
            $jadwalPertandingan->update($request->only('nama_pertandingan', 'waktu_mulai_pertandingan', 'waktu_akhir_pertandingan'));

            return response()->json('Berhasil update jadwal');
        }
    }

    public function delete($id)
    {
        $data = JadwalPertandingan::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus jadwal');
    }

    public function list(Request $request, $id) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = ListTimJadwalPertandingan::query()->with('tim', 'pertandingan')->where('id_pertandingan', $id);
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where(function($query) use ($searchTerm) {
                        $query->Where('id_tim', 'like', "%$searchTerm%")
                              ->orWhere('created_at', 'like', "%$searchTerm%");
                    });
                }
                
                $data = $query->paginate($perPage);
                return response()->json($data);
            }

            $requestData = $request->only(['id_tim']);
            $requestData['id_pertandingan'] = $id;
            ListTimJadwalPertandingan::create($requestData);

            return response()->json('Berhasil Membuat Data');
        }

        $jadwal = JadwalPertandingan::findOrFail($id);

        $tim = Tim::all();
        $nonExistingTim = collect();
        
        foreach ($tim as $atl) {
            $exists = ListTimJadwalPertandingan::where('id_pertandingan', $id)->where('id_tim', $atl->id)->exists();
            if (!$exists) {
                $nonExistingTim->push($atl);
            }
        }

        $data = [
            'title' => 'Data List Tim di Pertandingan ' . $jadwal->nama_pertandingan,
            'tim' => $nonExistingTim,
        ];
        return view('page.dashboard.list.jadwal_list_tim', compact('data'));
    }

    public function updateList(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!ListTimJadwalPertandingan::find($id)) {
                return response()->json('join not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(ListTimJadwalPertandingan::with('tim')->find($id));
            }
    
            $listTimeJadwal = ListTimJadwalPertandingan::find($id);
            $listTimeJadwal->update($request->only('id_tim')); 

            return response()->json('Berhasil update join');
        }
    }

    public function deleteList($id)
    {
        $data = ListTimJadwalPertandingan::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus join');
    }

    public function listAtlet(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = ListAtletInPertandingan::query()->with('jadwal', 'atlet')->where('id_jadwal_pertandingan', $id);
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where(function($query) use ($searchTerm) {
                        $query->Where('id_atlet', 'like', "%$searchTerm%")
                              ->orWhere('created_at', 'like', "%$searchTerm%");
                    });
                }
                
                $data = $query->paginate($perPage);
                return response()->json($data);
            }

            $requestData = $request->only(['id_atlet']);
            $requestData['id_jadwal_pertandingan'] = $id;
            ListAtletInPertandingan::create($requestData);

            return response()->json('Berhasil Membuat Data');
        }

        $pertandingan = JadwalPertandingan::findOrFail($id);

        $atlet = Atlet::all();
        $nonExistingAtlet = collect();
        
        foreach ($atlet as $atl) {
            $exists = ListAtletInPertandingan::where('id_jadwal_pertandingan', $id)->where('id_atlet', $atl->id)->exists();
            if (!$exists) {
                $nonExistingAtlet->push($atl);
            }
        }

        $data = [
            'title' => 'Data List Atlet di Pertandingan ' . $pertandingan->nama_pertandingan,
            'atlet' => $nonExistingAtlet,
        ];
        return view('page.dashboard.list.list_atlet_in_pertandingan', compact('data'));
    }

    public function updateListAtlet(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!ListAtletInPertandingan::find($id)) {
                return response()->json('join not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(ListAtletInPertandingan::with('atlet')->find($id));
            }
    
            $listAtlet = ListAtletInPertandingan::find($id);
            $listAtlet->update($request->only('id_atlet')); 

            return response()->json('Berhasil update join');
        }
    }

    public function deleteListAtlet($id)
    {
        $data = ListAtletInPertandingan::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus join');
    }
}
