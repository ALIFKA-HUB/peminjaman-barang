@extends('template.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Aset Rusak / Hilang</h1>
        <span class="badge bg-navy">Total Aset Bermasalah: {{ $data->count() }}</span>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Peminjam Terakhir</th>
                        <th>Barang</th>
                        <th>Status</th>
                        <th>Nilai Ganti Rugi</th>
                        <th>Tanggal Kejadian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->nama_peminjam }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>
                                <span class="badge bg-dark">{{ strtoupper($item->status) }}</span>
                            </td>
                            <td class="text-danger fw-bold">
                                Rp{{ number_format($item->denda, 0, ',', '.') }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_kembali_realitas)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
