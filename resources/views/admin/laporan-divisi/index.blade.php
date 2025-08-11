@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-chart-bar me-2"></i> Laporan Divisi
        </h4>
        {{-- <a href="{{ route('pengurus.laporan-divisi.create') }}" class="btn btn-sm btn-primary px-3 shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Laporan
        </a> --}}
    </div>

    {{-- Error Notification --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Data Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Divisi</th> {{-- ✅ Kolom baru --}}
                            <th>Jumlah Adik</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->divisi->nama ?? '-' }}</td> {{-- ✅ Nama divisi --}}
                                <td>{{ $item->jumlah_adik }}</td>
                                <td>Rp{{ number_format($item->pemasukan, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($item->pengeluaran, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->bulan)->translatedFormat('F') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->bulan)->format('Y') }}</td>
                                {{-- <td class="text-center">
                                    <a href="{{ route('pengurus.laporan-divisi.edit', $item->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <form action="{{ route('pengurus.laporan-divisi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td> --}}

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada laporan divisi.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
