@extends('template.layout')

@section('content')
    <h1>Daftar Sanksi & Denda</h1>
    <p class="text-muted">Catatan denda yang harus ditagih kepada peminjam.</p>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="table-sanksi">
                <thead>
                    <tr>
                        <th>Nama Peminjam</th>
                        <th>Barang</th>
                        <th>Alasan Sanksi</th>
                        <th>Total Denda</th>
                        <th>Status Barang</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $sanksi)
                        <tr>
                            <td>{{ $sanksi->nama_peminjam }}</td>
                            <td>{{ $sanksi->barang->nama }}</td>
                            <td>
                                @if ($sanksi->status == 'kembali')
                                    <span class="text-warning">Keterlambatan Pengembalian</span>
                                @else
                                    <span class="text-danger">Kerusakan / Kehilangan Unit</span>
                                @endif
                            </td>
                            <td class="fw-bold">
                                Rp{{ number_format($sanksi->denda, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge {{ $sanksi->status == 'kembali' ? 'bg-success' : 'bg-dark' }}">
                                    {{ ucfirst($sanksi->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada sanksi atau denda.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total Kas Masuk (Piutang):</th>
                        <th colspan="2" class="text-primary">Rp{{ number_format($data->sum('denda'), 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
