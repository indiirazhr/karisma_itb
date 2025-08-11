@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-clipboard-list me-2"></i> Daftar Program Tersedia
        </h4>
        <a href="{{ route('Peserta.pendaftaran-program.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        @forelse($programs as $program)
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card h-100 shadow-sm border-0 hover-shadow">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-info text-dark">{{ $program->created_at->format('d M Y') }}</span>
                        </div>

                          <div class="portfolio-image">
                            <img src="{{ asset('storage/' . $program->file_path) }}" class="img-fluid" " loading="lazy">
                            <div class="portfolio-overlay">
                                <div class="portfolio-actions">
                                <a href="{{ asset('storage/' . $program->file_path) }}" class="glightbox preview-link" data-gallery="product-gallery">
                                    <i class="bi bi-eye"></i>
                                </a>
                                </div>
                            </div>
                            </div>

                            <td>
                                @if ($program->file_path)
                                    <a href="{{ asset('storage/' . $program->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                        <h5 class="fw-semibold text-primary">{{ $program->judul }}</h5>
                        <p>{{ $program->waktu }}</p>
                        <p>{{ $program->lokasi }}</p>

                        {{-- Deskripsi dengan modal --}}
                        @php
                            $isLong = strlen(strip_tags($program->deskripsi)) > 120;
                            $deskripsiSingkat = Str::limit(strip_tags($program->deskripsi), 120);
                        @endphp
                        <p class="text-muted small mb-2">
                            {{ $deskripsiSingkat }}
                            @if($isLong)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalProgram{{ $program->id }}">Lihat selengkapnya</a>
                            @endif
                        </p>

                        @if(in_array($program->id, $sudahDaftar))
                            <span class="badge bg-secondary mt-auto">✅ Sudah Didaftar</span>
                        @else
                            <form action="{{ route('Peserta.pendaftaran-program.store') }}" method="POST" class="mt-auto">
                                @csrf
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                <div class="mb-2">
                                    <textarea name="alasan" class="form-control form-control-sm" rows="2" placeholder="Alasan mengikuti program (opsional)"></textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-success w-100">
                                    <i class="fas fa-paper-plane me-1"></i> Daftar Sekarang
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Modal Deskripsi Panjang --}}
            @if($isLong)
            <div class="modal fade" id="modalProgram{{ $program->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $program->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $program->id }}">{{ $program->judul }}</h5>
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
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada program tersedia saat ini.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
