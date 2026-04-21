<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Mengambil semua data peminjaman beserta data barangnya (eager loading)
        $peminjamans = \App\Models\Peminjaman::with('barang')->latest()->get();

        // Pastikan nama variabel di compact() sama dengan yang di blade
        return view('history', compact('peminjamans'));
    }
}
