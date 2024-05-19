<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atlet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AtletController extends Controller
{
    private function jsonResponse($message, $data = null, $status)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    private function handleFotoUpload(Request $request)
    {
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('fotos'), $fileName);
            return $fileName;
        }
        return null;
    }

    private function handleFotoKTPUpload(Request $request)
    {
        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = $request->file('foto_ktp');
            $fileName = time() . '.' . $foto_ktp->getClientOriginalExtension();
            $foto_ktp->move(public_path('foto_ktps'), $fileName);
            return $fileName;
        }
        return null;
    }

    private function handleIjazahKarateUpload(Request $request)
    {
        if ($request->hasFile('ijazah_karate')) {
            $ijazah_karate = $request->file('ijazah_karate');
            $fileName = time() . '.' . $ijazah_karate->getClientOriginalExtension();
            $ijazah_karate->move(public_path('ijazah_karates'), $fileName);
            return $fileName;
        }
        return null;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'ttl' => 'required',
            'jenis_kelamin' => 'required',
            'berat_badan' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'foto_ktp' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'ijazah_karate' => 'required|mimes:pdf,jpg,png,jpeg|max:2048'
        ]);

        $atlet = new Atlet();
        $atlet->nama = $request->nama;
        $atlet->ttl = $request->ttl;
        $atlet->jenis_kelamin = $request->jenis_kelamin;
        $atlet->berat_badan = $request->berat_badan;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/fotos');
            $atlet->foto = basename($fotoPath);
        }

        if ($request->hasFile('foto_ktp')) {
            $fotoKtpPath = $request->file('foto_ktp')->store('public/foto_ktps');
            $atlet->foto_ktp = basename($fotoKtpPath);
        }

        if ($request->hasFile('ijazah_karate')) {
            $ijazahKaratePath = $request->file('ijazah_karate')->store('public/ijazah_karates');
            $atlet->ijazah_karate = basename($ijazahKaratePath);
        }

        $atlet->save();

        return response()->json(['success' => true]);
    }

    
    public function destroy($id)
    {
        $atlet = Atlet::findOrFail($id);
        $atlet->delete();

        return response()->json(['success' => true]);
    }
    public function indexManager(Request $request)
    {
        $data = [
            'title' => 'myAtlet',
            'user' => User::where('role', 'manager')->get(),
            'atlet' => Atlet::with('user')->where('nama', Auth::user()->id)->get(),    
        ];
        return view('page.dashboard.manager.myAtlet', compact('data'));
    }
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = Atlet::query();
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where('nama', 'like', "%$searchTerm%")
                        ->orWhere('ttl', 'like', "%$searchTerm%")
                        ->orWhere('jenis_kelamin', 'like', "%$searchTerm%")
                        ->orWhere('berat_badan', 'like', "%$searchTerm%")
                        ->orWhere('foto', 'like', "%$searchTerm%")
                        ->orWhere('foto_ktp', 'like', "%$searchTerm%")
                        ->orWhere('ijazah_karate', 'like', "%$searchTerm%");
                }
            
                return response()->json($query->paginate($perPage));
            }

            $foto = $this->handleFotoUpload($request);
            $foto_ktp = $this->handleFotoKTPUpload($request);
            $ijazah_karate = $this->handleIjazahKarateUpload($request);

            Atlet::create([
                'nama'=> $request->nama,
                'ttl'=> $request->ttl,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'berat_badan'=> $request->berat_badan,
                'foto'=> $foto,
                'foto_ktp'=> $foto_ktp,
                'ijazah_karate'=> $ijazah_karate,
            ]);

            return response()->json('Berhasil Membuat Data');
        }

        $data = [
            'title' => 'Data Atlet'
        ];
        return view('page.dashboard.atlet', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Atlet::find($id)) {
                return response()->json('atlet not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(Atlet::find($id));
            }
    
            $atlet = Atlet::find($id);
            $atlet->update($request->only('nama', 'ttl', 'jenis_kelamin', 'berat_badan'));

            $foto = $this->handleFotoUpload($request);
            $foto_ktp = $this->handleFotoKTPUpload($request);
            $ijazah_karate = $this->handleIjazahKarateUpload($request);
            
            $attributes = [
                'foto' => $foto,
                'foto_ktp' => $foto_ktp,
                'ijazah_karate' => $ijazah_karate,
            ];
            
            foreach ($attributes as $attribute => $value) {
                if ($value !== null) {
                    $atlet->$attribute = $value;
                }
            }
            
            if (!empty(array_filter($attributes))) {
                $atlet->save();
            }
            
            return response()->json('Berhasil update atlet');
        }
    }

    public function delete($id)
    {
        $data = Atlet::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus atlet');
    }
}