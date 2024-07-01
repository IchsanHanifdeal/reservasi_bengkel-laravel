<?php

namespace App\Http\Controllers;

use App\Models\Mekanik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MekanikController extends Controller
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
        return view('mekanik', [
            'title' => 'Mekanik',
            'active' => 'mekanik',
            'role' => $role,
            'id_user' => $id_user,
            'namadepan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
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
            'nama_mekanik' => 'required|unique:mekanik,nama_mekanik',
        ], [
            'nama_mekanik.unique' => 'Nama Mekanik sudah terdaftar, silahkan daftarkan mekanik lain'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $mekanik = Mekanik::create([
                'nama_mekanik' => $request->nama_mekanik,
            ]);
            toastr()->success('Pendaftaran Mekanik Berhasil!');
            return redirect()->route('mekanik');
        } catch (\Exception $e) {
            toastr()->error('Pendaftaran gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mekanik $mekanik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mekanik $mekanik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_mekanik)
    {
        $validator = Validator::make($request->all(), [
            'nama_mekanik' => 'required|unique:mekanik,nama_mekanik,' . $id_mekanik . ',id_mekanik',
            'kehadiran' => 'required',
        ], [
            'nama_mekanik.unique' => 'Nama Mekanik sudah terdaftar, silahkan daftarkan mekanik lain'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mekanik = Mekanik::find($id_mekanik);
        if (!$mekanik) {
            toastr()->error('Mekanik tidak ditemukan');
            return redirect()->route('mekanik');
        }

        try {
            $mekanik->update([
                'nama_mekanik' => $request->nama_mekanik,
                'kehadiran' => $request->kehadiran,
            ]);
            toastr()->success('Pendaftaran Mekanik Berhasil!');
            return redirect()->route('mekanik');
        } catch (\Exception $e) {
            toastr()->error('Pendaftaran gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id_mekanik)
    {
        $mekanik = Mekanik::find($id_mekanik);

        if ($mekanik) {
            $mekanik->delete();
            toastr()->success('mekanik terhapus!', 'success');
        } else {
            toastr()->error('mekanik tidak ditemukan!', 'error');
        }

        return redirect()->back();
    }
}
