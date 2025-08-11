@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-4">Detail Dokumentasi</h4>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>Judul:</strong> {{ $dokumentasi->judul }}</p>
            <p><strong>Kegiatan:</strong> {{ $dokumentasi->kegiatan->judul ?? '-' }}</p>
            <p><strong>Deskripsi:</strong> {{ $dokumentasi->description }}</p>
            <p><strong>Tanggal Kegiatan:</strong> {{ $dokumentasi->kegiatan->tanggal ?? '-' }}</p>
        </div>
    </div>

    <div class="row">
        @forelse ($dokumentasi->files as $file)
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    @if(Str::endsWith($file->file_path, ['jpg','jpeg','png']))
                        <img src="{{ asset('storage/' . $file->file_path) }}" class="card-img-top" alt="Foto Dokumentasi">
                    @else
                        <div class="p-3">
                            <i class="fas fa-file-alt fa-2x text-secondary"></i>
                            <p class="mt-2 small">{{ basename($file->file_path) }}</p>
                        </div>
                    @endif
                    <div class="card-footer text-center">
                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                        <a href="{{ asset('storage/' . $file->file_path) }}" download class="btn btn-sm btn-outline-success">Download</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada file.</p>
        @endforelse
    </div>

    <div class="mt-4">
        <a href="{{ route('pengurus.dokumentasi.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>
@endsection
