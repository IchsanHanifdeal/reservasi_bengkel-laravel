<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Jasa;
use App\Models\Mekanik;
use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role = $request->session()->get('role');
        $nama_depan = $request->session()->get('nama_depan');
        $nama_belakang = $request->session()->get('nama_belakang');
        $id_user = $request->session()->get('id_user');
        $jumlah_pelanggan = Perbaikan::count();
        $jumlah_mekanik = Mekanik::count();
        $jumlah_item = Item::count();
        $jumlah_jasa = Jasa::count();
        $perbaikan = Perbaikan::all();
        $selected_id_items = [];
        $selected_id_jasas = [];
        if ($role == 'admin') {
            return view('admin_dashboard', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'role' => $role,
                'id_user' => $id_user,
                'namadepan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'total_pelanggan' => $jumlah_pelanggan,
                'total_mekanik' => $jumlah_mekanik,
                'total_item' => $jumlah_item,
                'jumlah_jasa' => $jumlah_jasa,
                'perbaikan' => $perbaikan,
                'jasas' => Jasa::all(),
                'mekanik' => Mekanik::all(),
                'items' => Item::all(),
                'selected_id_items' => $selected_id_items,
                'selected_id_jasas' => $selected_id_jasas,
            ]);
        } else {
            $role = $request->session()->get('role');
            $nama_depan = $request->session()->get('nama_depan');
            $nama_belakang = $request->session()->get('nama_belakang');
            $id_user = $request->session()->get('id_user');
            
            $perbaikan = DB::table('perbaikan')
                ->select('id_perbaikan', 'nama_mobil', 'no_whatsapp', 'plat_mobil', 'tentang_kerusakan', 'status')
                ->where('id_user', $id_user)
                ->first();
            
            $no_whatsapp = '';
            $id_perbaikan = '';
            $nama_mobil = '';
            $plat_mobil = '';
            $tentang_kerusakan = '';
            $readonly = '';
            $status = '';
            
            if ($perbaikan) {
                $id_perbaikan = $perbaikan->id_perbaikan;
                $nama_mobil = $perbaikan->nama_mobil;
                $plat_mobil = isset($perbaikan->plat_mobil) ? $perbaikan->plat_mobil : '';
                $tentang_kerusakan = $perbaikan->tentang_kerusakan;
                $no_whatsapp = $perbaikan->no_whatsapp;
                $status = $perbaikan->status;
                $readonly = 'readonly';
            }
            
            $allReadOnly = !empty($nama_mobil) && !empty($plat_mobil) && !empty($tentang_kerusakan) && !empty($no_whatsapp);
            
            return view('user_dashboard', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'id_user' => $id_user,
                'id_perbaikan' => $id_perbaikan,
                'perbaikan' => $perbaikan,
                'nama_depan' => $request->session()->get('nama_depan'),
                'nama_belakang' => $request->session()->get('nama_belakang'),
                'nama_mobil' => $nama_mobil,
                'plat_mobil' => $plat_mobil,
                'no_whatsapp' => $no_whatsapp,
                'tentang_kerusakan' => $tentang_kerusakan,
                'readonly' => $readonly,
                'status' => $status,
                'no_whatsapp' => $no_whatsapp,
                'allReadOnly' => $allReadOnly,
            ]);
        }
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


    /**
     * Display the specified resource.
     */
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
}
