@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">Pendaftaran Program</h4>
        <a href="{{ route('Peserta.pendaftaran-program.list') }}" class="btn btn-success">
            <i class="bi bi-plus-lg me-1"></i> Daftar Program Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-white" style="background-color: #198754; border-color: #157347;">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @elseif(session('warning'))
        <div class="alert alert-warning text-dark">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('warning') }}
        </div>
    @endif

    @if($pendaftarans->isEmpty())
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
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftarans as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->program->judul }}</td>
                                <td>{{ $item->alasan ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->status === 'pending' ? 'warning' : ($item->status === 'disetujui' ? 'success' : 'danger') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
