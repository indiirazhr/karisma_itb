@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <div class="mb-4">
        <h4 class="fw-bold text-primary">
            <i class="fas fa-user-plus me-2"></i> Tambah User Baru
        </h4>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.data-user.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $id => $role)
                            <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="divisi-container" style="display: none;">
                    <label for="divisi_id" class="form-label">Divisi</label>
                    <select name="divisi_id" class="form-select">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach ($divisis as $id => $divisi)
                            <option value="{{ $id }}" {{ old('divisi_id') == $id ? 'selected' : '' }}>
                                {{ $divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.data-user.index') }}" class="btn btn-secondary">Batal</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const roleSelect = document.querySelector('select[name="role_id"]');
        const divisiContainer = document.getElementById('divisi-container');

        function toggleDivisi() {
            if (roleSelect.value == '2') {
                divisiContainer.style.display = 'block';
            } else {
                divisiContainer.style.display = 'none';
            }
        }

        // Jalankan saat load dan saat berubah
        toggleDivisi();
        roleSelect.addEventListener('change', toggleDivisi);
    });
</script>
@endsection


