<?php

namespace App\Http\Controllers;

use App\Models\loans;
use App\Http\Requests\StoreloansRequest;
use App\Http\Requests\UpdateloansRequest;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data peminjaman beserta data barangnya (eager loading)
        $peminjamans = \App\Models\Peminjaman::with('barang')->latest()->get();

        // Pastikan nama variabel di compact() sama dengan yang di blade
        return view('history', compact('peminjamans'));
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
    public function store(StoreloansRequest $request)
    {
        // 1. Cari barangnya
        $item = \App\Models\Item::findOrFail($request->barang_id);

        // 2. Cek apakah stok cukup
        if ($item->total_stok <= 0) {
            return redirect()->back()->with('error', 'Stok barang habis!');
        }

        // 3. Simpan data peminjaman
        \App\Models\Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam, // pastikan name di input sesuai
            'jenis_identitas' => $request->jenis_identitas,
            'barang_id' => $request->barang_id,
            'lama_pinjam' => $request->lama_pinjam,
            'tgl_pinjam' => now(),
            'status' => 'dipinjam'
        ]);

        // 4. POTONG STOK OTOMATIS
        $item->decrement('total_stok');

        return redirect()->route('history.index')->with('success', 'Berhasil meminjam barang!');
    }

    /**
     * Display the specified resource.
     */
    public function show(loans $loans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loans $loans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateloansRequest $request, loans $loans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loans $loans)
    {
        //
    }
}
