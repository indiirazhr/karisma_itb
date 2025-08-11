@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="text-primary fw-bold mb-3"><i class="fas fa-edit me-2"></i> Edit Kategori</h4>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $category->nama) }}" required>
        </div>
        <button class="btn btn-warning">Update</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
