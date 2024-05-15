<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Kelas;
use App\Models\KelasListUser;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    private function jsonResponse($message, $data = null, $status)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }
    
    public function indexManager(Request $request)
    {
        $data = [
            'title' => 'myClasses',
            'user' => User::where('role', 'manager')->get(),
            'classes' => Kelas::with('user')->where('nama_kelas', Auth::user()->id)->first(),
        ];
        return view('page.dashboard.manager.myClasses', compact('data'));
    }
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = Kelas::query()->with('kategori');
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where('nama_kelas', 'like', "%$searchTerm%")
                        ->orWhere('kategori', 'like', "%$searchTerm%")
                        ->orWhere('bb', 'like', "%$searchTerm%")
                        ->orWhere('created_at', 'like', "%$searchTerm%");
                }
            
                return response()->json($query->paginate($perPage));
            }

            Kelas::create([
                'nama_kelas'=> $request->nama_kelas,
                'kategori'=> $request->kategori,
                'bb'=> $request->bb,
            ]);

            return response()->json('Berhasil Membuat Data');
        }

        $data = [
            'title' => 'Data Kelas',
            'kategori' => Kategori::all()
        ];
        return view('page.dashboard.kelas', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Kelas::find($id)) {
                return response()->json('kelas not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(Kelas::find($id));
            }
    
            $kelas = Kelas::find($id);
            $kelas->update($request->only('nama_kelas', 'kategori', 'bb'));

            return response()->json('Berhasil update kelas');
        }
    }

    public function delete($id)
    {
        $data = Kelas::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus kelas');
    }

    public function list(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = KelasListUser::query()->with('kelas', 'atlet')->where('id_kelas', $id);
                
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
            $requestData['id_kelas'] = $id;
            KelasListUser::create($requestData);

            return response()->json('Berhasil Membuat Data');
        }

        $kelas = Kelas::findOrFail($id);

        $atlet = Atlet::all();
        $nonExistingAtlet = collect();
        
        foreach ($atlet as $atl) {
            $exists = KelasListUser::where('id_kelas', $id)->where('id_atlet', $atl->id)->exists();
            if (!$exists) {
                $nonExistingAtlet->push($atl);
            }
        }

        $data = [
            'title' => 'Data List User Kelas ' . $kelas->nama_kelas,
            'atlet' => $nonExistingAtlet,
        ];
        return view('page.dashboard.list.kelas_list_atlet', compact('data'));
    }

    public function updateList(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!KelasListUser::find($id)) {
                return response()->json('join not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(KelasListUser::with('atlet')->find($id));
            }
    
            $kelasListUser = KelasListUser::find($id);
            $kelasListUser->update($request->only('id_atlet')); 

            return response()->json('Berhasil update join');
        }
    }

    public function deleteList($id)
    {
        $data = KelasListUser::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus join');
    }
}
