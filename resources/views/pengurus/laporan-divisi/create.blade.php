@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-plus me-2"></i> Tambah Laporan Divisi
        </h4>
        <a href="{{ route('pengurus.laporan-divisi.index') }}" class="btn btn-sm btn-secondary px-3 shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
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

    {{-- Form --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengurus.laporan-divisi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="jumlah_adik" class="form-label">Jumlah Adik</label>
                    <input type="number" name="jumlah_adik" class="form-control" value="{{ old('jumlah_adik') }}" required min="0">
                </div>

               <div class="mb-3">
                    <label for="pemasukan" class="form-label">Pemasukan</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="pemasukan" class="form-control"
                            value="{{ old('pemasukan', $laporan->pemasukan ?? '') }}"
                            required min="0" step="0.01">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pengeluaran" class="form-label">Pengeluaran</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="pengeluaran" class="form-control"
                            value="{{ old('pengeluaran', $laporan->pengeluaran ?? '') }}"
                            required min="0" step="0.01">
                    </div>
                </div>


                <div class="mb-3">
                    <label for="bulan" class="form-label">Bulan</label>
                    <select name="bulan" class="form-select" required>
                        <option value="">-- Pilih Bulan --</option>
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ old('bulan') == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" value="{{ old('tahun', date('Y')) }}" required min="2000" max="{{ date('Y') + 1 }}">
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success px-4">
                    <i class="fas fa-save me-1"></i> Simpan Laporan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
