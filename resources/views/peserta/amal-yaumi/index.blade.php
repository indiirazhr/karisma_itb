@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-check-circle me-2"></i> Input Amal Yaumi Hari Ini
        </h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($data)
        <div class="alert alert-info shadow-sm">
            <i class="fas fa-info-circle me-2"></i> Kamu sudah mengisi Amal Yaumi hari ini. Terima kasih! 😊
        </div>
    @else
        <form action="{{ route('Peserta.amal-yaumi.store') }}" method="POST">
            @csrf

            @php
                $fields = [
                    'sholat_5_waktu' => ['ya', 'tidak', 'halangan'],
                    'sholat_dhuha' => ['ya', 'tidak'],
                    'qiyamul_lail' => ['ya', 'tidak'],
                    'puasa_sunnah' => ['ya', 'tidak'],
                    'tilawah' => ['ya', 'tidak'],
                    'membaca_buku' => ['ya', 'tidak'],
                    'membantu_orang_tua' => ['ya', 'tidak'],
                    'mengerjakan_tugas' => ['ya', 'tidak'],
                ];
            @endphp

            @foreach($fields as $field => $options)
                <div class="mb-4">
                    <label class="form-label fw-semibold text-capitalize">
                        {{ str_replace('_', ' ', $field) }}
                    </label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($options as $opt)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="{{ $field }}" value="{{ $opt }}" required id="{{ $field.'_'.$opt }}">
                                <label class="form-check-label" for="{{ $field.'_'.$opt }}">
                                    {{ ucfirst($opt) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error($field)
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
