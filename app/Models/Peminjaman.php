<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    // BARIS INI WAJIB ADA supaya Laravel tidak mencari tabel 'peminjamen'
    protected $table = 'peminjamans';

    protected $guarded = [];

    // Relasi ke tabel Item
    public function barang()
    {
        return $this->belongsTo(Item::class, 'barang_id');
    }

    /**
     * Accessor: info_status
     * Cara panggil di Blade: $pjm->info_status['warna']
     */
    public function getInfoStatusAttribute()
    {
        // Pastikan tgl_pinjam diubah jadi objek Carbon dulu
        $tgl_pinjam = Carbon::parse($this->tgl_pinjam);
        $deadline = $tgl_pinjam->copy()->addDays($this->lama_pinjam);
        $hari_ini = Carbon::now()->startOfDay();

        // 1. Jika sudah selesai (Kembali, Rusak, atau Hilang)
        if ($this->status !== 'dipinjam') {
            return [
                'warna' => $this->status == 'kembali' ? 'bg-success' : 'bg-dark',
                'teks' => ucfirst($this->status),
                'denda_final' => $this->denda
            ];
        }

        // 2. Cek jika sudah melewati deadline (Terlambat)
        if ($hari_ini->gt($deadline)) {
            $selisih = $hari_ini->diffInDays($deadline);
            return [
                'warna' => 'bg-danger',
                'teks' => 'Terlambat ' . $selisih . ' Hari',
                'denda_telat' => $selisih * 10000
            ];
        }

        // 3. Cek jika hari ini adalah H-1 sebelum deadline
        if ($hari_ini->equalTo($deadline->copy()->subDay())) {
            return [
                'warna' => 'bg-warning text-dark',
                'teks' => 'H-1 Kembali',
                'denda_telat' => 0
            ];
        }

        // 4. Status normal masih dipinjam
        return [
            'warna' => 'bg-primary',
            'teks' => 'Dipinjam',
            'denda_telat' => 0
        ];
    }
}
