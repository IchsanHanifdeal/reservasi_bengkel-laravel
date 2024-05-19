<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Jasa;
use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pemilik' => 'required|string',
            'id_user' => 'required|integer',
            'nama_mobil' => 'required|string',
            'plat_mobil' => 'required|string',
            'tentang_kerusakan' => 'required|string',
            'tanggal_mulai' => 'required|date',
        ]);

        // Create a new Perbaikan instance with the validated data
        $perbaikan = Perbaikan::create($validatedData);

        // Redirect to a relevant route after storing the Perbaikan
        return redirect()->route('dashboard')->with('success', 'Perbaikan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id_perbaikan)
    {
        $nama_depan = $request->session()->get('nama_depan');
        $nama_belakang = $request->session()->get('nama_belakang');
        $id_user = $request->session()->get('id_user');
        $email = $request->session()->get('email');
        
        $name = $nama_depan . ' ' . $nama_belakang;
        
        if ($request->has('id_perbaikan')) {
            $idToUpdate = $request->input('id_perbaikan');
            $sqlGetData = "SELECT * FROM perbaikan WHERE id_perbaikan = ?";
            $rowData = DB::selectOne($sqlGetData, [$idToUpdate]);
        
            if ($rowData) {
                $id_user = $rowData->id_user;
                $queryPemilik = "SELECT nama_depan, nama_belakang FROM users WHERE id_user = ?";
                $rowPemilik = DB::selectOne($queryPemilik, [$id_user]);
                if ($rowPemilik) {
                    $nama_pelanggan = $rowPemilik->nama_depan . ' ' . $rowPemilik->nama_belakang;
                } else {
                    echo "No user found with the ID: $id_user";
                }
        
                $id_mekanik = $rowData->id_mekanik;
            }
        }
        
        $query = "SELECT id_perbaikan, nama_mobil, plat_mobil, tentang_kerusakan, status, harga_total, id_mekanik, tanggal_mulai, tanggal_selesai FROM perbaikan WHERE id_user = ?";
        $rowData = DB::selectOne($query, [$id_user]);
        
        $nama_mobil = '';
        $plat_mobil = '';
        $tentang_kerusakan = '';
        $no_whatsapp = '';
        $readonly = '';
        if ($rowData) {
            $id_perbaikan = $rowData->id_perbaikan;
            $nama_mobil = $rowData->nama_mobil;
            $plat_mobil = $rowData->plat_mobil;
            $tentang_kerusakan = $rowData->tentang_kerusakan;
            $status = $rowData->status;
            $harga_total = $rowData->harga_total;
            $id_mekanik = $rowData->id_mekanik;
            $tanggal_mulai = $rowData->tanggal_mulai;
            $tanggal_selesai = $rowData->tanggal_selesai;
            $readonly = 'readonly';
        }
        
        return view('nota', compact('name', 'email', 'nama_mobil', 'harga_total', 'tanggal_mulai', 'tanggal_selesai'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perbaikan $perbaikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_perbaikan)
    {
        $validator = Validator::make($request->all(), [
            'tentang_kerusakan' => 'required|string',
            'tanggal_selesai' => 'required|date',
            'id_mekanik' => 'required|exists:mekanik,id_mekanik',
            'status' => 'required|in:belum diproses,sudah diproses,sudah selesai',
            'id_item' => 'array',
            'id_item.*' => 'exists:item,id_item',
            'id_jasa' => 'array',
            'id_jasa.*' => 'exists:jasa,id_jasa',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $perbaikan = Perbaikan::findOrFail($id_perbaikan);
            $perbaikan->update([
                'tentang_kerusakan' => $request->tentang_kerusakan,
                'tanggal_selesai' => $request->tanggal_selesai,
                'id_mekanik' => $request->id_mekanik,
                'status' => $request->status,
            ]);

            $perbaikan->items()->sync($request->id_item ?: []);
            $perbaikan->jasa()->sync($request->id_jasa ?: []);

            $totalHarga = Item::whereIn('id_item', $request->id_item ?: [])->sum('harga') +
                Jasa::whereIn('id_jasa', $request->id_jasa ?: [])->sum('harga');
            $perbaikan->update(['harga_total' => $totalHarga]);

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Data perbaikan berhasil di perbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perbaikan $perbaikan)
    {
        //
    }
}
