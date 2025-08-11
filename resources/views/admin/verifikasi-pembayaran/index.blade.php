@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    {{-- Judul dan Tombol Export --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">
            <i class="fas fa-money-check-alt me-2"></i> Verifikasi Pembayaran
        </h4>
        <a href="{{ route('admin.verifikasi-pembayaran.export.pdf') }}" class="btn btn-outline-secondary">
            <i class="fas fa-file-pdf me-1"></i> Export PDF
        </a>

    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert" style="background-color: #0ba100; color: #1a3d2f; border: 1px solid #17d61e;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel dibungkus dengan ID khusus untuk PDF --}}
    <div class="card border-0 shadow-sm" id="exportArea">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Adik</th>
                            <th>Nominal</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th class="text-end d-print-none">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayaran as $item)
                            <tr>
                                <td>
    @if($item->user)
        {{ $item->user->name }}
    @else
        <span class="text-danger">User null ({{ $item->user_id }})</span>
    @endif
</td>

                                <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        Lihat Bukti
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-{{ 
                                        $item->status === 'valid' ? 'success' : 
                                        ($item->status === 'tidak valid' ? 'danger' : 'warning') }} text-capitalize px-3 py-1 rounded-pill shadow-sm">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="text-end d-print-none">
                                    @if($item->status === 'pending')
                                        <form action="{{ route('admin.verifikasi-pembayaran.update', $item->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="valid">
                                            <button class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-check me-1"></i> Valid
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.verifikasi-pembayaran.update', $item->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="tidak valid">
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-times me-1"></i> Tidak Valid
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Sudah diverifikasi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


