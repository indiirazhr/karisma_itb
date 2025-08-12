@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <h4 class="fw-bold text-primary mb-3"><i class="fas fa-edit me-2"></i> Edit Program</h4>

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
                <form action="{{ route('admin.program.update', $program->id) }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Program</label>
                        <input type="text" name="judul" class="form-control"
                            value="{{ old('judul', $program->judul) }}" required>
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
                                <label for="waktu">Waktu</label>
                                <input type="time" name="waktu" class="form-control" value="{{ old('waktu', $program->waktu) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="waktu">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $program->tanggal) }}">
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="waktu">Waktu Berakhir</label>
                                <input type="time" name="waktu_berakhir" value="{{ old('waktu', $program->waktu_berakhir) }}" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                            <label for="waktu">Tanggal Berakhir</label>
                            <input type="date" name="tanggal_berakhir"  value="{{ old('tanggal', $program->tanggal_berakhir) }}" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="batas_pendaftar">Batas Pendaftar</label>
                        <input type="number" name="batas_pendaftar" class="form-control" value="{{ old('batas_pendaftar', $program->batas_pendaftar) }}">
                    </div>

                    <div class="mb-3">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $program->lokasi) }}">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $program->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Ganti File </label>
                        <input type="file" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        @if ($program->file_path)
                            <small class="d-block mt-1">File saat ini: <a
                                    href="{{ asset('storage/' . $program->file_path) }}" target="_blank">Lihat</a></small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Perbarui
                    </button>
                    <a href="{{ route('admin.program.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
