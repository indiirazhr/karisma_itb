@extends('layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary mb-0">
                <i class="fas fa-users me-2"></i> Verifikasi User
            </h4>
        </div>

        {{-- Error Notification --}}
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filter Form --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <h4 class="mb-3">Daftar peserta yang belum di verifikasi</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kartu Pelajar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $user->kartu_pelajar) }}" class="btn btn-info"
                                        target="_blank">
                                        Lihat
                                    </a>

                                </td>
                                <td>
                                    <form action="{{ route('admin.verifikasi-user.approve', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data verifikasi peserta</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endsection
