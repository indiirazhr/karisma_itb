@extends('layouts.main')

@section('title', 'Data Dokumentasi')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-4 d-flex justify-content-between">
        <span>Data Dokumentasi</span>
        <div>
            <a href="{{ route('pengurus.dokumentasi.export-dok.pdf') }}" target="_blank" class="btn btn-outline-secondary me-2">Export PDF</a>
            <a href="{{ route('pengurus.dokumentasi.create') }}" class="btn btn-primary">+ Tambah Dokumentasi</a>
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
                <table class="table table-bordered align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Kegiatan</th>
                            <th>Deskripsi</th>
                            <th>Jumlah File</th>
                            <th>Tanggal Kegiatan</th>
                            <th class="text-center no-export">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dokumentasi as $item)
                            <tr>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->kegiatan->judul ?? '-' }}</td>
                                <td>{{ $item->description}}</td>
                                <td>{{ $item->files->count() }} file</td>
                                <td>{{ $item->kegiatan->tanggal ?? '-' }}</td>
                                <td class="text-center no-export">
                                    <a href="{{ route('pengurus.dokumentasi.show', $item->id) }}"
                                        class="btn btn-sm btn-info me-1"
                                        title="Lihat Dokumentasi">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus dokumentasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada dokumentasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

