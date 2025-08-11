@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-upload me-2"></i> Upload Bukti Pembayaran
        </h4>
        <a href="{{ route('Peserta.pembayaran.riwayat') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

     @if(session('success'))
        <div class="alert" style="background-color: #0ba100; color: #1a3d2f; border: 1px solid #17d61e;">
           <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif


    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('Peserta.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nominal" class="form-label fw-semibold">Nominal</label>
                    <input type="number" name="nominal" id="nominal" class="form-control {{ $errors->has('nominal') ? 'is-invalid' : '' }}" value="{{ old('nominal') }}" placeholder="Masukkan jumlah nominal" required>
                    @error('nominal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

               <div class="mb-3">
                    <label for="bukti_transfer" class="form-label fw-semibold">Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control {{ $errors->has('bukti_transfer') ? 'is-invalid' : '' }}" accept="image/*" required>
                    @error('bukti_transfer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i> Kirim Bukti
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
