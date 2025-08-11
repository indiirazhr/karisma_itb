@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-4">
        <i class="fas fa-list-alt me-2"></i> Data Pendaftaran Program
    </h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Program</th>
                        <th>Jumlah Pendaftar</th>
                        <th>Status</th>
                        {{-- <th>Tanggal Terakhir</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftarans as $programId => $grouped)
                        @php
                            $program = $grouped->first()->program;
                            $desc = strip_tags($program->deskripsi ?? '-');
                            $isLong = strlen($desc) > 50;
                            $short = \Illuminate\Support\Str::limit($desc, 50);
                            $latest = $grouped->sortByDesc('created_at')->first();
                            $statusCounts = $grouped->groupBy('status')->map->count();
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>
                                    <a href="{{ route('pengurus.pendaftaran.byProgram', $program->id) }}">
                                        {{ $program->judul }}
                                    </a>
                                </strong><br>
                                <small>{{ $short }}
                                    @if($isLong)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalDesc{{ $programId }}">selengkapnya</a>
                                    @endif
                                </small>
                            </td>
                            <td>{{ $grouped->count() }} peserta</td>
                            <td>
                                @foreach($statusCounts as $status => $count)
                                    <span class="badge bg-{{ 
                                        $status === 'pending' ? 'warning' : 
                                        ($status === 'disetujui' ? 'success' : 'danger') }}">
                                        {{ ucfirst($status) }} ({{ $count }})
                                    </span><br>
                                @endforeach
                            </td>
                            {{-- <td>{{ $latest->created_at->format('d M Y') }}</td> --}}
                        </tr>

                        {{-- Modal Deskripsi --}}
                        @if($isLong)
                        <div class="modal fade" id="modalDesc{{ $programId }}" tabindex="-1" aria-labelledby="descLabel{{ $programId }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="descLabel{{ $programId }}">{{ $program->judul }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        {!! nl2br(e($program->deskripsi)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pendaftaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
