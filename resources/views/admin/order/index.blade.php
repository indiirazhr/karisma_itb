@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-4 d-flex justify-content-between">
        <span>Daftar Pemesanan</span>
        <div>
            <a href="{{ route('admin.order.export.pdf') }}" class="btn btn-outline-secondary me-2" target="_blank">Export PDF</a>
        </div>
    </h4>

    @if(session('success'))
        <div class="alert" style="background-color: #0ba100; color: #1a3d2f; border: 1px solid #17d61e;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm" id="exportArea">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle shadow-sm">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Pemesan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Alamat</th>
                            <th class="text-center no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->product->name ?? '-' }}</td>
                            <td class="text-center">{{ $order->jumlah }}</td>
                            <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <strong>{{ $order->nama_pemesan ?? $order->user->name ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $order->email_pemesan ?? $order->user->email ?? '-' }}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-{{ 
                                    $order->status === 'dibayar' ? 'success' : 
                                    ($order->status === 'selesai' ? 'secondary' : 'warning') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="text-center">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="text-center">{{ $order->alamat ?? '-' }}</td>
                         <td class="text-center no-print">
                            <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select form-select-sm w-auto">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="dibayar" {{ $order->status === 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                    <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-sync-alt"></i> Simpan
                                </button>
                            </form>
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada pemesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>
@endsection


