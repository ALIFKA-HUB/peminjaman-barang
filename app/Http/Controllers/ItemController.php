<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreitemRequest;
use App\Http\Requests\UpdateitemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua data dari tabel items
        $items = Item::all();

        // 2. Kirim data ke view 'stok'
        return view('table', compact('items'));
    }

    public function manage()
    {
        $items = Item::all();
        return view('form', compact('items')); // Untuk halaman edit/tambah
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
    public function store(storeitemRequest $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'total_stok' => 'required|numeric'
        ]);

        \App\Models\Item::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'total_stok' => $request->total_stok,
        ]);
        return redirect()->back()->with('success', 'Barang berhasil ditambah!');
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
    public function update(UpdateitemRequest $request, $id)
    {
        $item = \App\Models\Item::findOrFail($id);
        $item->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'total_stok' => $request->total_stok,
        ]);
        return redirect()->back()->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }
}
