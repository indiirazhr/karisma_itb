@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="text-primary mb-4">Pesan Kontak Masuk</h4>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('admin.kontak.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau subjek..."
                   value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kontaks as $kontak)
                    <tr>
                        <td>{{ $kontak->name }}</td>
                        <td><a href="mailto:{{ $kontak->email }}">{{ $kontak->email }}</a></td>
                        <td>{{ $kontak->phone }}</td>
                        <td><span class="badge bg-primary">{{ $kontak->subject }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalKontak{{ $kontak->id }}">
                                Lihat Pesan
                            </button>

                            {{-- Modal --}}
                            <div class="modal fade" id="modalKontak{{ $kontak->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Pesan dari {{ $kontak->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Email:</strong> {{ $kontak->email }}</p>
                                            <p><strong>No HP:</strong> {{ $kontak->phone }}</p>
                                            <p><strong>Subjek:</strong> {{ $kontak->subject }}</p>
                                            <hr>
                                            <p>{{ $kontak->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $kontak->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada pesan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $kontaks->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
