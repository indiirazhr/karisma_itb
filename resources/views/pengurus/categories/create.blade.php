@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="text-primary fw-bold mb-3"><i class="fas fa-plus me-2"></i> Tambah Kategori</h4>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
