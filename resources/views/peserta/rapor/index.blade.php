@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
     <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0"><i class="fas fa-file-alt me-2"></i>  Raport </h4>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($rapors->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>File Rapor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rapors as $index => $rapor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rapor->user->name }}</td>
                            <td>
                                <a href="{{ route('Peserta.rapor.show', $rapor->id) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                    Lihat Rapor
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p class="text-muted text-center">Tidak ada rapor yang diupload.</p>
            @endif
        </div>
    </div>
</div>
@endsection
