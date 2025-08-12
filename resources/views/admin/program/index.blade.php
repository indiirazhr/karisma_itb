@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold text-primary mb-0"><i class="fas fa-list me-2"></i> Data Program</h4>
        <a href="{{ route('admin.program.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Program
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($programs->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Batas pendaftar</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Berakhir</th>
                            <th>Lokasi</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $index => $program)
                        @php
                            $isLong = strlen(strip_tags($program->deskripsi)) > 80;
                            $shortDesc = \Illuminate\Support\Str::limit(strip_tags($program->deskripsi), 80);
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $program->judul }}</td>
                            <td>{{ $program->batas_pendaftar }}</td>
                            <td>{{ $program->waktu }} {{ $program->tanggal }}</td>
                            <td>{{ $program->waktu_berakhir }} {{ $program->tanggal_berakhir }}</td>
                            <td>{{ $program->lokasi }}</td>
                            <td>{{ $program->category->nama ?? '-' }}</td>
                            <td>
                                {{ $shortDesc }}
                                @if($isLong)
                                    <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#modalDesc{{ $program->id }}">Selengkapnya</a>
                                @endif
                            </td>
                            <td>
                                @if ($program->file_path)
                                    <a href="{{ asset('storage/' . $program->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        Lihat File
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.program.edit', $program->id) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.program.destroy', $program->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus program ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Deskripsi --}}
                        @if($isLong)
                        <div class="modal fade" id="modalDesc{{ $program->id }}" tabindex="-1" aria-labelledby="descLabel{{ $program->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="descLabel{{ $program->id }}">{{ $program->judul }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        {!! nl2br(e($program->deskripsi)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p class="text-muted text-center mb-0">Belum ada data program.</p>
            @endif
        </div>
    </div>
</div>
@endsection
