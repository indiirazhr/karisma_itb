@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary mb-0">Pendaftaran Program</h4>
            <a href="{{ route('Peserta.pendaftaran-program.list') }}" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Daftar Program Baru
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-white" style="background-color: #198754; border-color: #157347;">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
        @elseif(session('warning'))
            <div class="alert alert-warning text-dark">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('warning') }}
            </div>
        @endif

        @if ($pendaftarans->isEmpty())
            <div class="alert alert-info text-dark">
                <i class="bi bi-info-circle me-2"></i> Kamu belum mendaftar ke program manapun.
            </div>
        @else
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Judul Program</th>
                                <th>Alasan</th>

                                <th>Tanggal Daftar</th>
                                <th>Presensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftarans as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->program->judul }}</td>
                                    <td>{{ $item->alasan ?? '-' }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>@if ($item->presensi) 
        <span class="badge bg-success">✅ Sudah Presensi</span>
    @else
        <a class="btn btn-primary" href="#"
            onclick="event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Kehadiran',
                text: 'Apakah Anda yakin Melakukan Presensi?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('presensi-{{ $item->id }}').submit();
                }
            });">
            {{ __('Presensi') }}
        </a>
        <form id="presensi-{{ $item->id }}" action="/Peserta/pendaftaran-program/presensi" method="POST" class="d-none">
            @csrf
            <input type="hidden" name="pendaftaran_id" value="{{ $item->id }}">
        </form>
    @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
