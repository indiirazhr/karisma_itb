@extends('layouts.main')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold text-primary mb-4">
        <i class="fas fa-user-edit me-2"></i> Edit Data User
    </h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.data-user.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        @foreach ($roles as $id => $role)
                            <option value="{{ $id }}" {{ $user->role_id == $id ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="aktif" {{ $user->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $user->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div> --}}

                <div class="text-end">
                    <a href="{{ route('admin.data-user.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
