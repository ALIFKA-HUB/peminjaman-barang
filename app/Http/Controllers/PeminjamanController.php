<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;

class PeminjamanController extends Controller
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
    public function store(StorePeminjamanRequest $request)
    {
        $item = Item::find($request->barang_id);

        if (!$item || $item->total_stok <= 0) {
            return redirect()->back()->with('error', 'Barang tidak tersedia atau stok habis.');
        }

        DB::transaction(function () use ($request, $item) {
            Peminjaman::create([
                'nama_peminjam'   => $request->nama_peminjam,
                'jenis_identitas' => $request->jenis_identitas,
                'barang_id'       => $request->barang_id,
                'lama_pinjam'     => $request->lama_pinjam,
                'tgl_pinjam'      => now(),
                'status'          => 'dipinjam'
            ]);

            $item->decrement('total_stok');
        });

        return redirect()->route('history.index')->with('success', 'Berhasil meminjam barang!');
    }

    // 1. Pengembalian Normal (Stok nambah, Denda telat otomatis)
    public function kembalikan($id)
    {
        $pjm = Peminjaman::findOrFail($id);

        if ($pjm->status !== 'dipinjam') {
            return redirect()->back()->with('error', 'Status peminjaman tidak valid untuk dikembalikan.');
        }

        $status_otomatis = $pjm->info_status;
        $denda_telat = $status_otomatis['denda_telat'] ?? 0;

        DB::transaction(function () use ($pjm, $denda_telat) {
            $pjm->update([
                'status' => 'kembali',
                'tgl_kembali_realitas' => now(),
                'denda' => $denda_telat,
            ]);

            $pjm->barang->increment('total_stok');
        });

        return redirect()->back()->with('success', 'Barang kembali! Denda telat: Rp' . number_format($denda_telat, 0, ',', '.'));
    }

    // 2. Barang Bermasalah (Stok TIDAK nambah, Denda input manual)
    public function bermasalah(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required|in:rusak,hilang',
            'denda_manual' => 'required|integer|min:0',
        ]);

        $pjm = Peminjaman::findOrFail($id);

        if ($pjm->status !== 'dipinjam') {
            return redirect()->back()->with('error', 'Status peminjaman tidak valid untuk diubah menjadi rusak/hilang.');
        }

        $pjm->update([
            'status' => $request->kondisi,
            'tgl_kembali_realitas' => now(),
            'denda' => $request->denda_manual,
        ]);

        return redirect()->back()->with('success', 'Sanksi telah dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeminjamanRequest $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }

    // Untuk Halaman Barang Hilang/Rusak
    public function halamanRusak()
    {
        $data = Peminjaman::whereIn('status', ['rusak', 'hilang'])->latest()->get();
        return view('barang_rusak', compact('data')); // sesuaikan nama filenya
    }

    // Untuk Halaman Sanction/Denda
    public function halamanSanksi()
    {
        // Ambil semua yang punya denda di atas 0
        $data = Peminjaman::where('denda', '>', 0)->latest()->get();
        return view('sanction', compact('data')); // sesuaikan nama filenya
    }
}
