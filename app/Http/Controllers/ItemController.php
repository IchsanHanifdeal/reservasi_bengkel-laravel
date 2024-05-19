<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
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
        return view('item', [
            'title' => 'Item',
            'active' => 'item',
            'role' => $role,
            'id_user' => $id_user,
            'namadepan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'item' => Item::all(),
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
            'nama_item' => 'required|unique:item,nama_item',
            'harga' => 'required',
        ], [
            'nama_item.unique' => 'Item sudah terdaftar, silahkan daftarkan Item lain'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $item = Item::create([
                'nama_item' => $request->nama_item,
                'harga' => $request->harga,
            ]);
            toastr()->success('Pendaftaran Item Berhasil!');
            return redirect()->route('item');
        } catch (\Exception $e) {
            toastr()->error('Pendaftaran gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_item)
    {
        $validator = Validator::make($request->all(), [
            'nama_item' => 'required|unique:item,nama_item',
            'harga' => 'required',
        ], [
            'nama_item.unique' => 'Item sudah terdaftar, silahkan daftarkan Item lain'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Item::find($id_item);
        if (!$item) {
            toastr()->error('Item tidak ditemukan');
            return redirect()->route('item');
        }

        try {
            $item->update([
                'nama_item' => $request->nama_item,
                'harga' => $request->harga,
            ]);
            toastr()->success('Pendaftaran Item Berhasil!');
            return redirect()->route('item');
        } catch (\Exception $e) {
            toastr()->error('Pendaftaran gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_item)
    {
        $Item = Item::find($id_item);

        if ($Item) {
            $Item->delete();
            toastr()->success('Item terhapus!', 'success');
        } else {
            toastr()->error('Item tidak ditemukan!', 'error');
        }

        return redirect()->back();
    }
}
