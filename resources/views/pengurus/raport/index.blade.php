@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
     <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0"><i class="fas fa-file-alt me-2"></i>  Raport Adik</h4>
        <a href="{{ route('pengurus.raport.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Raport
        </a>
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
                            <th>Adik</th>
                            <th>File Rapor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rapors as $index => $rapor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rapor->user->name }}</td>
                            <td>
                                <a href="{{ route('pengurus.raport.show', $rapor->id) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                    Lihat Rapor
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('pengurus.raport.destroy', $rapor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus rapor ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </form>
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
