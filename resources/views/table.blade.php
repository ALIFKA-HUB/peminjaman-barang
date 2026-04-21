@extends('template.layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
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
    <h1>Dashboard</h1>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Daftar Stok Barang</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalTambah">
                        + Tambah Produk
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Total Stok</th>
                                <th>Tersedia</th>
                                <th>Status</th>
                                <th>Aksi</th> {{-- Tambah kolom Aksi --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                @php
                                    $jumlah_dipinjam = 0;
                                    $sisa = $item->total_stok - $jumlah_dipinjam;
                                @endphp
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->total_stok }}</td>
                                    <td>{{ $sisa }}</td>
                                    <td>
                                        @if ($sisa > 0)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Kosong</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">Edit</button>

                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin?')">Hapus</button>
                                        </form>

                                        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Barang: {{ $item->nama }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body text-start">
                                                            <div class="mb-3">
                                                                <label>Nama Barang</label>
                                                                <input type="text" name="nama" class="form-control"
                                                                    value="{{ $item->nama }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Kategori</label>
                                                                <select name="kategori" class="form-control">
                                                                    <option value="Elektronik"
                                                                        {{ $item->kategori == 'Elektronik' ? 'selected' : '' }}>
                                                                        Elektronik</option>
                                                                    <option value="Alat Tulis"
                                                                        {{ $item->kategori == 'Alat Tulis' ? 'selected' : '' }}>
                                                                        Alat Tulis</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Total Stok</label>
                                                                <input type="number" name="total_stok" class="form-control"
                                                                    value="{{ $item->total_stok }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('items.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="nama">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Laptop Asus"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="form-control" required>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Alat Tulis">Alat Tulis</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="total_stok">Total Stok</label>
                            <input type="number" name="total_stok" class="form-control" min="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
