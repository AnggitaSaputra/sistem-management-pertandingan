<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use App\Models\TimListUser;
use App\Models\User;
use App\Models\Atlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimController extends Controller
{
    private function handleImgUpload(Request $request)
    {
        if ($request->hasFile('foto_tim')) {
            $foto_tim = $request->file('foto_tim');
            $fileName = time() . '.' . $foto_tim->getClientOriginalExtension();
            $foto_tim->move(public_path('foto_tims'), $fileName);
            return $fileName;
        }
        return null;
    }

    private function handleFileUpload(Request $request)
    {
        if ($request->hasFile('surat_tugas')) {
            $surat_tugas = $request->file('surat_tugas');
            $fileName = time() . '.' . $surat_tugas->getClientOriginalExtension();
            $surat_tugas->move(public_path('surat_tugass'), $fileName);
            return $fileName;
        }
        return null;
    }

    public function indexManager(Request $request)
    {
        $manager =Auth::user();
        $data = [
            'title' => 'myTim',
            'user' => User::where('role', 'manager')->get(),
            'team' => Tim::with('user')->where('manager', Auth::user()->id)->first(),
            'manager' => $manager,
        ];
        // dd($data);
        return view('page.dashboard.manager.myTim', compact('data'));
    }


    public function index(Request $request) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = Tim::query()->with('user');
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where('nama_tim', 'like', "%$searchTerm%")
                        ->orWhere('asal_institusi', 'like', "%$searchTerm%")
                        ->orWhere('email', 'like', "%$searchTerm%")
                        ->orWhere('alamat', 'like', "%$searchTerm%")
                        ->orWhere('manager', 'like', "%$searchTerm%")
                        ->orWhere('no_hp', 'like', "%$searchTerm%")
                        ->orWhere('foto_tim', 'like', "%$searchTerm%")
                        ->orWhere('surat_tugas', 'like', "%$searchTerm%")
                        ->orWhere('created_at', 'like', "%$searchTerm%");
            }
            
                return response()->json($query->paginate($perPage));
            }

            $foto_tim = $this->handleImgUpload($request);
            $surat_tugas = $this->handleFileUpload($request);

            Tim::create([
                'nama_tim'=> $request->nama_tim,
                'asal_institusi'=> $request->asal_institusi,
                'email'=> $request->email,
                'alamat'=> $request->alamat,
                'manager'=> $request->manager,
                'no_hp'=> $request->no_hp,
                'foto_tim'=> $foto_tim,
                'surat_tugas'=> $surat_tugas,
            ]);

            return response()->json('Berhasil Membuat Data');
        }

        $data = [
            'title' => 'Data Tim',
            'user' => User::where('role', 'manager')->get()
        ];
        return view('page.dashboard.tim', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Tim::find($id)) {
                return response()->json('tim not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(Tim::find($id));
            }
    
            $tim = Tim::find($id);
            $tim->update($request->only('nama_tim', 'asal_institusi', 'email', 'alamat', 'manager', 'no_hp'));

            $foto_tim = $this->handleImgUpload($request);
            $surat_tugas = $this->handleFileUpload($request);
            
            if ($foto_tim !== null || $surat_tugas !== null) {
                if ($foto_tim !== null && $surat_tugas !== null) {
                    $tim->foto_tim = $foto_tim;
                    $tim->surat_tugas = $surat_tugas;
                    $tim->save();
                } elseif ($foto_tim !== null) {
                    $tim->foto_tim = $foto_tim;
                    $tim->save();
                } elseif ($surat_tugas !== null) {
                    $tim->surat_tugas = $surat_tugas;
                    $tim->save();
                }
            }            

            return response()->json('Berhasil update tim');
        }
    }

    public function delete($id)
    {
        $data = Tim::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus tim');
    }

    public function list(Request $request, $id) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = TimListUser::query()->with('user', 'atlet')->where('id_tim', $id);
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where(function($query) use ($searchTerm) {
                        $query->where('id_official', 'like', "%$searchTerm%")
                            ->orWhere('id_atlet', 'like', "%$searchTerm%")
                            ->orWhere('created_at', 'like', "%$searchTerm%");
                    });
                }
                
                $data = $query->paginate($perPage);
                return response()->json($data);
            }
            
            $requestData = $request->only(['id_official', 'id_atlet']);
            $requestData['id_tim'] = $id;
            TimListUser::create($requestData);
    
            return response()->json('Berhasil membuat join');
        }
    
        $tim = Tim::findOrFail($id);
        $atlets = Atlet::all();
        $nonExistingAtlets = collect();
        
        foreach ($atlets as $atlet) {
            $exists = TimListUser::where('id_atlet', $atlet->id)->exists();
            if (!$exists) {
                $nonExistingAtlets->push($atlet);
            }
        }

        $official = User::where('role', 'official')->get();
        $nonExistingOfficial = collect();
        
        foreach ($official as $ofc) {
            $exists = TimListUser::where('id_official', $ofc->id)->exists();
            if (!$exists) {
                $nonExistingOfficial->push($ofc);
            }
        }
        
        $data = [
            'title' => 'Data List ' . $tim->nama_tim,
            'official' => $nonExistingOfficial,
            'atlet' => $nonExistingAtlets,
        ];
        return view('page.dashboard.list.tim_list_atlet', compact('data'));
    }    

    public function updateList(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!TimListUser::find($id)) {
                return response()->json('join not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(TimListUser::with('atlet', 'user')->find($id));
            }
    
            $timListUser = TimListUser::find($id);
            $timListUser->update($request->only('id_tim', 'id_official', 'id_atlet')); 

            return response()->json('Berhasil update join');
        }
    }

    public function deleteList($id)
    {
        $data = TimListUser::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus join');
    }
}
