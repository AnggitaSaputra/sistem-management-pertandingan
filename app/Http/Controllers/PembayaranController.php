<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JadwalPertandingan;
use App\Models\ListAtletInPertandingan;
use App\Models\ListTimJadwalPertandingan;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use App\Models\Tim;
use App\Models\TimListUser;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Nette\Utils\DateTime;

class PembayaranController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $perPage = $request->input('per_page', 10);
                $query = Pembayaran::query()->with('tim', 'pertandingan');
                
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where('id_tim', 'like', "%$searchTerm%")
                          ->orWhere('total_pembayaran', 'like', "%$searchTerm%")
                          ->orWhere('status_pembayaran', 'like', "%$searchTerm%")
                          ->orWhere('created_at', 'like', "%$searchTerm%");
                }
            
                return response()->json($query->paginate($perPage));
            }

            $listAtletInPertandingan = ListAtletInPertandingan::all();
            $atletInPertandingan = collect();
            $groupedCounts = [];
            
            foreach ($listAtletInPertandingan as $ofc) {
                $exists = TimListUser::with('user', 'atlet', 'tim')->where('id_tim', $request->id_tim)->where('id_atlet', $ofc->id_atlet)->exists();
                if ($exists) {
                    $atletInPertandingan->push($ofc);
                }
            }
            
            $pengaturanFile = storage_path('app/pengaturan.json');
            $pengaturan = file_get_contents($pengaturanFile);
            $dataHarga = json_decode($pengaturan, true);
            
            $groupedCounts = $atletInPertandingan->groupBy('id_tim')->map(function ($items, $key) use ($dataHarga) {
                $totalPrice = $dataHarga['harga_per_team'];
                $atletPrice = $items->count() * $dataHarga['harga_per_atlet'];
                $totalPayment = $totalPrice + $atletPrice;
                return [
                    'id_tim' => $key,
                    'id_pertandingan' => $items[0]->id_jadwal_pertandingan,
                    'total_pembayaran' => $totalPayment,
                    'status_pembayaran' => 'pending'
                ];
            })->values()->all();
            
            $recordsToInsert = [];
            foreach ($groupedCounts as $group) {
                $recordsToInsert[] = [
                    'id_tim' => $group['id_tim'],
                    'id_pertandingan' => $group['id_pertandingan'],
                    'total_pembayaran' => $group['total_pembayaran'],
                    'status_pembayaran' => $group['status_pembayaran'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            Pembayaran::insert($recordsToInsert);

            return response()->json('Success membuat pembayaran');
        }

        $tim = Tim::all();
        $nonExistingTim = collect();
        
        foreach ($tim as $ofc) {
            $exists = Pembayaran::where('id_tim', $ofc->id)->exists();
            if (!$exists) {
                $nonExistingTim->push($ofc);
            }
        }

        $data = [
            'title' => 'Data Pembayaran',
            'tim' => $nonExistingTim,
            'pertandingan' => JadwalPertandingan::all(),
        ];
        return view('page.dashboard.pembayaran', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if (!Pembayaran::find($id)) {
                return response()->json('Pembayaran not found.');
            }
    
            if ($request->isMethod('get')) {
                return response()->json(Pembayaran::with('tim')->find($id));
            }
    
            $Pembayaran = Pembayaran::find($id);
            $Pembayaran->update($request->only('status_pembayaran'));

            return response()->json('Berhasil update Pembayaran');
        }
    }

    public function delete($id)
    {
        $data = Pembayaran::findOrFail($id);
        $data->delete();
        return response()->json('Berhasil hapus Pembayaran');
    }

    public function pengaturanHarga(Request $request)
    {
        if ($request->ajax()) {
            if ($request->isMethod('get')) {
                $pengaturanFile = storage_path('app/pengaturan.json');
    
                if (!file_exists($pengaturanFile)) {
                    $defaultPengaturan = [
                        'harga_per_team' => 0,
                        'harga_per_atlet' => 0
                    ];
                    file_put_contents($pengaturanFile, json_encode($defaultPengaturan));
                }
    
                $pengaturan = file_get_contents($pengaturanFile);
    
                return response()->json(json_decode($pengaturan));
            }
            
            $pengaturanData = $request->all();
    
            $hargaPerTeam = isset($pengaturanData['harga_per_team']) ? $pengaturanData['harga_per_team'] : null;
            $hargaPerAtlet = isset($pengaturanData['harga_per_atlet']) ? $pengaturanData['harga_per_atlet'] : null;
    
            if ($hargaPerTeam !== null && $hargaPerAtlet !== null) {
                $pengaturanFile = storage_path('app/pengaturan.json');
                $updatedPengaturan = [
                    'harga_per_team' => $hargaPerTeam,
                    'harga_per_atlet' => $hargaPerAtlet
                ];
    
                file_put_contents($pengaturanFile, json_encode($updatedPengaturan));
                return response()->json('success');
            } else {
                return response()->json('Incomplete data provided');
            }
        }   
        
        $data = [
            'title' => 'Pengaturan Pembayaran',
        ];
        return view('page.dashboard.pembayaran_pengaturan', compact('data'));
    }    

    public function fetchJadwalPertandingan(Request $request)
    {
        $jadwalPertandingan = ListTimJadwalPertandingan::with('tim')->where('id_pertandingan', $request->id_pertandingan)->get();
        $nonExistingPembayaran = collect();
        
        foreach ($jadwalPertandingan as $ofc) {
            $exists = Pembayaran::where('id_tim', $ofc->tim->id)->where('id_pertandingan', $request->id_pertandingan)->exists();
            if (!$exists) {
                $nonExistingPembayaran->push($ofc);
            }
        }

        return response()->json($nonExistingPembayaran);
    }

    public function pembayaranManager(Request $request)
    {
        $findTim = Tim::with('user')->where('manager', Auth::user()->id)->first();

        $jadwal = JadwalPertandingan::all();
    
        $nearestDate = null;
        $minDiff = PHP_INT_MAX;
    
        foreach ($jadwal as $jadwal) {
            $waktuMulai = new DateTime($jadwal->waktu_mulai_pertandingan);
            $now = new DateTime();
    
            $diff = abs($waktuMulai->getTimestamp() - $now->getTimestamp());
    
            if ($diff < $minDiff) {
                $idPertandingan = $jadwal->id;
                $namaPertandingan = $jadwal->nama_pertandingan;
                $minDiff = $diff;
            }
        }

        $jadwalDetail = [
            'id' => $idPertandingan,
            'namaPertandingan' => $namaPertandingan
        ];

        $data = [
            'pertandingan' => $jadwalDetail ?? null,
            'checkTim' => ListTimJadwalPertandingan::with('tim', 'pertandingan')->where('id_tim', $findTim->id)->where('id_pertandingan', $idPertandingan)->first(),
            'title' => 'Pembayaran',
            'pembayaran' => Pembayaran::with('tim', 'pertandingan')->where('status_pembayaran', ['success', 'failed'])->where('id_tim', $findTim->id)->get(),
            'tagihan' => Pembayaran::with('tim', 'pertandingan')->where('status_pembayaran', 'pending')->where('id_tim', $findTim->id)->first()
        ];

        return view('page.dashboard.pembayaran_manager', compact('data'));
    }
    
    public function pembayaranManagerDetail(Request $request, $idTeam, $idPertandingan)
    {
        if ($request->ajax()) {
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = true;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $dataPembayaran = Pembayaran::with('tim', 'pertandingan')->where('id_tim', $idTeam)->where('id_pertandingan', $idPertandingan)->first();
           
            $grossAmount = (int) $request->total_pembayaran;

            $params = array(
                'transaction_details' => array(
                    'order_id' => 'ORDER-' . time(),
                    'gross_amount' => $grossAmount,
                ),
                'payment_type' => 'gopay',
                'customer_details' => array(
                    'first_name' => $dataPembayaran->tim->user->nama,
                    'email' => $dataPembayaran->tim->user->email,
                ),
            );

            $snapToken = Snap::getSnapToken($params);

            return response()->json($snapToken);
        }

        $data = [
            'title' => 'Detail Pembayaran',
            'detail' => Pembayaran::with('tim', 'pertandingan')->where('id_tim', $idTeam)->where('id_pertandingan', $idPertandingan)->first(),
            'listAtlet' => ListAtletInPertandingan::with('atlet', 'jadwal', 'tim')->where('id_tim', $idTeam)->where('id_jadwal_pertandingan', $idPertandingan)->get()
        ];
        return view('page.dashboard.pembayaran_detail', compact('data'));
    }

    public function updatePaymentStatus(Request $request, $idTim, $idPertandingan)
    {
        $findUser = Pembayaran::with('tim', 'pertandingan')->where('id_tim', $idTim)->where('id_pertandingan', $idPertandingan)->first();

        Pembayaran::where('id_tim', $idTim)
                  ->where('id_pertandingan', $idPertandingan)
                  ->update(['status_pembayaran' => $request->status]);
        
        Notifikasi::createNotification([
            'type' => 'info',
            'id_user' => $findUser->tim->user->id,
            'message' => 'Berhasil melakukan pembayaran ID:'.$findUser->id
        ]);
        return response()->json('Berhasil melakukan pembayaran!');
    }
}
