<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atlet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AtletController extends Controller
{
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
        // Validation can be added here

        if ($request->ajax()) {
            // Fetching data
            // Pagination and search filtering
            $perPage = $request->input('per_page', 10);
            $query = Atlet::query();
            
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where('nama', 'like', "%$searchTerm%")
                    ->orWhere('ttl', 'like', "%$searchTerm%")
                    ->orWhere('jenis_kelamin', 'like', "%$searchTerm%")
                    ->orWhere('berat_badan', 'like', "%$searchTerm%");
            }
        
            $data = $query->paginate($perPage);

            return response()->json($data);
        }

        return response()->json('Invalid request', 400);
    }

    public function update(Request $request, $id)
    {
        // Validation can be added here

        if ($request->ajax()) {
            $atlet = Atlet::findOrFail($id);
            $atlet->update($request->only('nama', 'ttl', 'jenis_kelamin', 'berat_badan'));

            // Handle file uploads if any
            // You can refactor this to a single method if desired

            return response()->json('Atlet updated successfully');
        }

        return response()->json('Invalid request', 400);
    }

    public function delete($id)
    {
        $atlet = Atlet::findOrFail($id);
        $atlet->delete();
        return response()->json('Atlet deleted successfully');
    }
}
