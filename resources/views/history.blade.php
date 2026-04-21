@extends('template.layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Riwayat Peminjaman</h1>
    <div class="page-content">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Identitas</th>
                    <th>Barang</th>
                    <th>Tgl Pinjam</th>
                    <th>Lama (Hari)</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $pjm)
                    <tr>
                        <td>{{ $pjm->nama_peminjam }}</td>
                        <td>{{ $pjm->jenis_identitas }}</td>
                        <td>{{ $pjm->barang->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($pjm->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td>{{ $pjm->lama_pinjam }} Hari</td>
                        <td>
                            <span class="badge {{ $pjm->info_status['warna'] }}">
                                {{ $pjm->info_status['teks'] }}
                            </span>
                        </td>
                        <td>
                            Rp{{ number_format($pjm->denda, 0, ',', '.') }}
                        </td>
                        <td>
                            @if ($pjm->status == 'dipinjam')
                                <div class="d-flex gap-2">
                                    <form action="{{ route('peminjaman.kembali', $pjm->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Kembalikan</button>
                                    </form>

                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalMasalah{{ $pjm->id }}">
                                        Rusak/Hilang
                                    </button>
                                </div>

                                <div class="modal fade" id="modalMasalah{{ $pjm->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Catat Rusak/Hilang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('peminjaman.bermasalah', $pjm->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Kondisi</label>
                                                        <select name="kondisi" class="form-control" required>
                                                            <option value="">-- Pilih Kondisi --</option>
                                                            <option value="rusak">Rusak</option>
                                                            <option value="hilang">Hilang</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Denda</label>
                                                        <input type="number" name="denda_manual" min="0"
                                                            class="form-control" placeholder="Masukkan nilai denda"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
