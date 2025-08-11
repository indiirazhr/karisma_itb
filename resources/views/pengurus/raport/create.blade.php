@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold text-primary mb-3"><i class="fas fa-upload me-2"></i> Upload Rapor Adik</h4>

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

    {{-- Form Upload Rapor --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengurus.raport.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Pilih Adik --}}
                <div class="mb-3">
                    <label for="user_id" class="form-label">Pilih Adik</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih Adik --</option>
                        @foreach($adiks as $adik)
                            <option value="{{ $adik->id }}">{{ $adik->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- File Rapor --}}
                <div class="mb-3">
                    <label for="file" class="form-label">Upload Rapor</label>
                    <input type="file" name="file" class="form-control" required accept=".jpg,.jpeg,.png,.pdf">
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-success">Upload Rapor</button>
                <a href="{{ route('pengurus.raport.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
