@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-3"><i class="fas fa-check-circle me-2"></i> Amal Yaumi Adik</h4>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($amalYaumi->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Adik</th>
                            <th>Sholat 5 Waktu</th>
                            <th>Sholat Dhuha</th>
                            <th>Qiyamul Lail</th>
                            <th>Puasa Sunnah</th>
                            <th>Tilawah</th>
                            <th>Membaca Buku</th>
                            <th>Membantu Orang Tua</th>
                            <th>Mengerjakan Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($amalYaumi as $index => $amal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $amal->user->name }}</td>
                            <td>{{ $amal->sholat_5_waktu }}</td>
                            <td>{{ $amal->sholat_dhuha }}</td>
                            <td>{{ $amal->qiyamul_lail }}</td>
                            <td>{{ $amal->puasa_sunnah }}</td>
                            <td>{{ $amal->tilawah }}</td>
                            <td>{{ $amal->membaca_buku }}</td>
                            <td>{{ $amal->membantu_orang_tua }}</td>
                            <td>{{ $amal->mengerjakan_tugas }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p class="text-muted text-center">Tidak ada data Amal Yaumi yang diinputkan.</p>
            @endif
        </div>
    </div>
</div>
@endsection
