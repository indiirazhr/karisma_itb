@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-history me-2"></i> Riwayat Pembayaran
        </h4>
        <a href="{{ route('Peserta.pembayaran.create') }}" class="btn btn-primary">
            <i class="fas fa-upload me-1"></i> Upload Bukti Pembayaran
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th style="width: 50px;">#</th>
                        <th>Nominal</th>
                        <th>Bukti Transfer</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $pembayaran)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </td>
                            <td>
                                <span class="badge 
                                    {{ $pembayaran->status === 'valid' ? 'bg-success' : 
                                       ($pembayaran->status === 'tidak valid' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                    {{ ucfirst($pembayaran->status) }}
                                </span>
                            </td>
                            <td>{{ $pembayaran->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle me-2"></i> Belum ada pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
