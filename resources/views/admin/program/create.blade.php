@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <h4 class="fw-bold text-primary mb-3"><i class="fas fa-plus me-2"></i> Tambah Program</h4>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.program.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Program</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $program->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="waktu">Waktu Mulai</label>
                                <input type="time" name="waktu" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                            <label for="waktu">Tanggal Mulai</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="waktu">Waktu Berakhir</label>
                                <input type="time" name="waktu_berakhir" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                            <label for="waktu">Tanggal Berakhir</label>
                            <input type="date" name="tanggal_berakhir" class="form-control">
                        </div>
                    </div>

                     <div class="mb-3">
                        <label for="batas_pendaftar">Batas Pendaftar</label>
                        <input type="number" name="batas_pendaftar" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File / Gambar </label>
                        <input type="file" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('admin.program.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
