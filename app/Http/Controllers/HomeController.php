<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Peminjaman;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Statistik dasar
        $totalBarang = Item::count();
        $totalStok = Item::sum('total_stok');
        $totalPeminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $totalDenda = Peminjaman::sum('denda');

        // Hitung peminjaman terlambat
        $peminjamanTerlambat = 0;
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        foreach ($peminjamans as $pjm) {
            $info = $pjm->info_status;
            if ($info['denda_telat'] > 0) {
                $peminjamanTerlambat++;
            }
        }

        // Barang yang stoknya rendah (< 5)
        $barangStokRendah = Item::where('total_stok', '<', 5)->count();

        return view('home', compact(
            'totalBarang',
            'totalStok',
            'totalPeminjamanAktif',
            'totalDenda',
            'peminjamanTerlambat',
            'barangStokRendah'
        ));
    }
}
