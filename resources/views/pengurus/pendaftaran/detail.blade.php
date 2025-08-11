@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between flex-wrap gap-3 mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="fas fa-users me-2"></i> Peserta untuk Program: {{ $program->judul }}
        </h4>

        <div class="d-flex flex-column flex-md-row gap-2 align-items-end">
            <a href="{{ route('pengurus.pendaftaran.index') }}" class="btn btn-secondary">
                ← Kembali
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExportPdf">
                <i class="fas fa-file-pdf me-1"></i> Export PDF
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>WA</th>
                        <th>Sekolah</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($program->pendaftarans as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->user->email ?? '-' }}</td>
                            <td>{{ $item->user->no_wa ?? '-' }}</td>
                            <td>{{ $item->user->asal_sekolah ?? '-' }}</td>
                            <td>{{ $item->alasan ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $item->status === 'pending' ? 'warning' : 
                                    ($item->status === 'disetujui' ? 'success' : 'danger') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td class="text-nowrap">
                                <form action="{{ route('pengurus.pendaftaran.updateStatus', $item->id) }}" method="POST" class="d-inline-flex gap-1 align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm me-1">
                                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="disetujui" {{ $item->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                        <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary" title="Update Status">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <form action="{{ route('pengurus.pendaftaran.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus pendaftaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada pendaftar untuk program ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Export PDF -->
<div class="modal fade" id="modalExportPdf" tabindex="-1" aria-labelledby="modalExportPdfLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('pengurus.pendaftaran.exportPdf', $program->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExportPdfLabel">Export PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
              <div class="modal-body">
                    <div class="mb-3">
                        <label for="ttd_nama" class="form-label">Nama Penandatangan</label>
                        <input type="text" name="ttd_nama" id="ttd_nama" class="form-control"
                            value="{{ auth()->user()->name ?? 'Pengurus Divisi' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="ttd_tanggal" class="form-label">Tanggal TTD</label>
                        <input type="date" name="ttd_tanggal" id="ttd_tanggal" class="form-control"
                            value="{{ now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="ttd_lokasi" class="form-label">Lokasi TTD</label>
                        <input type="text" name="ttd_lokasi" id="ttd_lokasi" class="form-control"
                            value="Bandung" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-file-pdf me-1"></i> Download PDF
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
