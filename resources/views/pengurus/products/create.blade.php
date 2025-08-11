@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-3">Tambah Produk</h4>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="no_rekening" class="form-label">Nomor Rekening</label>
            <input type="text" name="no_rekening" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Foto Produk</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Simpan Produk</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
