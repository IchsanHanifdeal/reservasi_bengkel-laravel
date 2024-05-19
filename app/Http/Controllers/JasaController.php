<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Mekanik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JasaController extends Controller
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
        return view('jasa', [
            'title' => 'Jasa',
            'active' => 'jasa',
            'role' => $role,
            'id_user' => $id_user,
            'namadepan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'jasa' => Jasa::all(),
            'mekanik' => Mekanik::all(),
        ]);
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
        $validator = Validator::make($request->all(), [
            'nama_jasa' => 'required',
            'id_mekanik' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $jasa = Jasa::create([
                'nama_jasa' => $request->nama_jasa,
                'id_mekanik' => $request->id_mekanik,
                'harga' => $request->harga,
            ]);
            toastr()->success('Pendaftaran Jasa Berhasil!');
            return redirect()->route('jasa');
        } catch (\Exception $e) {
            toastr()->error('Pendaftaran gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jasa $jasa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jasa $jasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_jasa)
    {
        $validator = Validator::make($request->all(), [
            'nama_jasa' => 'required',
            'id_mekanik' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jasa = Jasa::find($id_jasa);
        if (!$jasa) {
            toastr()->error('Jasa tidak ditemukan');
            return redirect()->route('jasa');
        }

        try {
            $jasa->update([
                'nama_jasa' => $request->nama_jasa,
                'id_mekanik' => $request->id_mekanik,
                'harga' => $request->harga,
            ]);
            toastr()->success('Ubah Jasa Berhasil!');
            return redirect()->route('jasa');
        } catch (\Exception $e) {
            toastr()->error('Ubah gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id_jasa)
    {
        $jasa = Jasa::find($id_jasa);

        if ($jasa) {
            $jasa->delete();
            toastr()->success('Jasa terhapus!', 'success');
        } else {
            toastr()->error('Jasa tidak ditemukan!', 'error');
        }

        return redirect()->back();
    }
}
