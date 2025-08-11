@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-3">Edit Produk</h4>

    {{-- Tampilkan error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="no_rekening" class="form-label">No. Rekening</label>
            <input type="text" name="no_rekening" class="form-control" value="{{ old('no_rekening', $product->no_rekening) }}">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto Produk</label><br>
            @if ($product->photo)
                <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto Produk" width="120" class="mb-2 d-block">
            @endif
            <input type="file" name="photo" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        </div>

        <div class="text-end">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
