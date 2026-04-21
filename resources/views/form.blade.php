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

    <h1>Form Peminjaman</h1>
    <div class="page-content">
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Multiple Column</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('form.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-3">
                                                <label>Nama Peminjam</label>
                                                <input type="text" class="form-control" name="nama_peminjam"
                                                    placeholder="Masukkan nama lengkap" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-3">
                                                <label>Jenis Identitas</label>
                                                <select name="jenis_identitas" class="form-control" required>
                                                    <option value="KTP">KTP</option>
                                                    <option value="KTM">KTM / Kartu Pelajar</option>
                                                    <option value="SIM">SIM</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-3">
                                                <label>Pilih Barang</label>
                                                <select class="form-control" name="barang_id" required>
                                                    <option value="">-- Pilih Barang --</option>
                                                    @foreach ($items as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->total_stok <= 0 ? 'disabled' : '' }}>
                                                            {{ $item->nama }} (Sisa: {{ $item->total_stok }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-3">
                                                <label>Lama Pinjam (Hari)</label>
                                                <input type="number" class="form-control" name="lama_pinjam" min="1"
                                                    max="3" placeholder="Contoh: 3" required>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Pinjam
                                                Sekarang</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Daftar Barang yang Tersedia
                    </h5>
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

                                    {{-- Kolom Tersedia --}}
                                    <td>{{ $sisa }}</td>

                                    {{-- Kolom Status --}}
                                    <td>
                                        @if ($sisa > 0)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Kosong</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
