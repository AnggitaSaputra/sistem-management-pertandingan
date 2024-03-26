<?php

namespace App\Http\Controllers;

use App\Models\JadwalPertandingan;
use App\Models\ListTimJadwalPertandingan;
use App\Models\ListAtletInPertandingan;
use App\Models\Tim;
use App\Models\TimListUser;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;

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

            try {
                $existingJadwal = JadwalPertandingan::where(function ($query) use ($request) {
                    $query->whereBetween('waktu_mulai_pertandingan', [$request->waktu_mulai_pertandingan, $request->waktu_akhir_pertandingan])
                          ->orWhereBetween('waktu_akhir_pertandingan', [$request->waktu_mulai_pertandingan, $request->waktu_akhir_pertandingan])
                          ->orWhere(function ($query) use ($request) {
                              $query->where('waktu_mulai_pertandingan', '<=', $request->waktu_mulai_pertandingan)
                                    ->where('waktu_akhir_pertandingan', '>=', $request->waktu_akhir_pertandingan);
                          });
                })->first();
        
                if ($existingJadwal) {
                    return response()->json('Jadwal pertandingan tumpang tindih dengan jadwal yang sudah ada');
                } else {
                    JadwalPertandingan::create([
                        'nama_pertandingan' => $request->nama_pertandingan,
                        'waktu_mulai_pertandingan' => $request->waktu_mulai_pertandingan,
                        'waktu_akhir_pertandingan' => $request->waktu_akhir_pertandingan,
                    ]);
        
                    return response()->json('Berhasil Membuat Data');
                }
            } catch (\Exception $exception) {
                return response()->json('Terjadi kesalahan saat membuat data');
            }
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

    public function listAtlet(Request $request, $idTim, $idPertandingan)
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = ListAtletInPertandingan::query()->with('jadwal', 'atlet', 'tim')->where('id_tim', $idTim);
                
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
            $requestData['id_tim'] = $idTim;
            $requestData['id_jadwal_pertandingan'] = $idPertandingan;
            ListAtletInPertandingan::create($requestData);

            return response()->json('Berhasil Membuat Data');
        }

        $atlet = TimListUser::with('atlet')->where('id_tim', $idTim)->whereNull('id_official')->get();
        $nonExistingAtlet = collect();  
        
        foreach ($atlet as $atl) {
            $exists = ListAtletInPertandingan::where('id_tim', $idTim)->where('id_atlet', $atl->id_atlet)->exists();
            if (!$exists) {
                $nonExistingAtlet->push((object)[
                    'id' => $atl->id_atlet,
                    'nama' => $atl->atlet->nama
                ]);        
            }
        }

        $data = [
            'title' => 'Data List Atlet di Pertandingan ',
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

    public function jadwal()
    {
        $data = JadwalPertandingan::all();
    
        $nearestDate = null;
        $minDiff = PHP_INT_MAX;
    
        foreach ($data as $jadwal) {
            $waktuMulai = new DateTime($jadwal->waktu_mulai_pertandingan);
            $now = new DateTime();
    
            $diff = abs($waktuMulai->getTimestamp() - $now->getTimestamp());
    
            if ($diff < $minDiff) {
                $nearestDate = $jadwal->waktu_mulai_pertandingan;
                $namaPertandingan = $jadwal->nama_pertandingan;
                $minDiff = $diff;
            }
        }
    
        $data = [
            'nearestDate' => $nearestDate,
            'namaPertandingan' => $namaPertandingan,
        ];

        return response()->json($data);
    }
    
}
