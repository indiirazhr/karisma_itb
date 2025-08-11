{{-- resources/views/pengurus/dokumentasi/create.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-4">Tambah Dokumentasi</h4>

    @if(session('success'))
        <div class="alert" style="background-color: #0ba100; color: #1a3d2f; border: 1px solid #17d61e;">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('pengurus.dokumentasi.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Dokumentasi</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kegiatan_id" class="form-label">Pilih Kegiatan</label>
            <select name="kegiatan_id" class="form-select" required>
                <option value="">-- Pilih Kegiatan --</option>
                @foreach($kegiatanList as $id => $judul)
                    <option value="{{ $id }}">{{ $judul }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>


        <div class="mb-3">
            <label for="files" class="form-label">Upload File (bisa banyak)</label>
            <input type="file" name="files[]" class="form-control" multiple required>
            <small class="text-muted">Maksimal 2MB per file. Format: jpg, jpeg, png, pdf, docx</small>
        </div>

        <div class="text-end">
            <a href="{{ route('pengurus.dokumentasi.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Dokumentasi</button>
        </div>
    </form>
</div>
@endsection
