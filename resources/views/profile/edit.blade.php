@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit Profil</h4>
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan saat memperbarui profil:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    


    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        {{-- Data Diri --}}
        <h5 class="mb-3">🧍 Data Diri</h5>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        {{-- Domisili --}}
        <h5 class="mt-4 mb-3">📍 Domisili</h5>
        <div class="mb-3">
            <label>Provinsi</label>
            <select name="provinsi" id="provinsi" class="form-control" required>
                <option value="">Pilih Provinsi</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Kabupaten/Kota</label>
            <select name="kabupaten_kota" id="kabupaten_kota" class="form-control" required>
                <option value="">Pilih Kabupaten/Kota</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        {{-- Pendidikan --}}
        <h5 class="mt-4 mb-3">🎓 Pendidikan</h5>
        <div class="mb-3">
            <label>Asal Sekolah</label>
            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $user->asal_sekolah) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tahun Masuk</label>
            <input type="text" name="tahun_masuk" value="{{ old('tahun_masuk', $user->tahun_masuk) }}" class="form-control">
        </div>

        {{-- Sosial Media --}}
        <h5 class="mt-4 mb-3">📱 Sosial Media</h5>
        <div class="mb-3">
            <label>No. WhatsApp</label>
            <input type="text" name="no_wa" value="{{ old('no_wa', $user->no_wa) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Akun Instagram</label>
            <input type="text" name="instagram" value="{{ old('instagram', $user->instagram) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Akun TikTok</label>
            <input type="text" name="tiktok" value="{{ old('tiktok', $user->tiktok) }}" class="form-control">
        </div>

        {{-- Password --}}
        <h5 class="mt-4 mb-3">🔒 Keamanan</h5>
        <div class="mb-3">
            <label>Password Baru (opsional)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">💾 Simpan Perubahan</button>
    </form>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    const provinsiSelect = document.getElementById('provinsi');
    const kabupatenSelect = document.getElementById('kabupaten_kota');

    const selectedProvinsi = {!! json_encode(old('provinsi') ?? $user->provinsi ?? '') !!};
    const selectedKabupaten = {!! json_encode(old('kabupaten_kota') ?? $user->kabupaten_kota ?? '') !!};

    let provinsiList = [];

    fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
        .then(res => res.json())
        .then(data => {
            provinsiList = data;
            provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';

            data.forEach(item => {
                const option = new Option(item.name, item.name);
                if (item.name.trim() === selectedProvinsi.trim()) {
                    option.selected = true;
                }
                provinsiSelect.add(option);
            });

            const selected = provinsiList.find(p => p.name.trim() === selectedProvinsi.trim());
            if (selected) {
                loadKabupaten(selected.id);
            }
        })
        .catch(err => {
            console.error("Gagal memuat provinsi:", err);
            provinsiSelect.innerHTML = '<option value="">Gagal memuat data provinsi</option>';
        });

    provinsiSelect.addEventListener('change', function () {
        const selected = provinsiList.find(p => p.name === this.value);
        if (selected) {
            loadKabupaten(selected.id);
        } else {
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        }
    });

    function loadKabupaten(provId) {
        if (!provId) return;
        kabupatenSelect.innerHTML = '<option value="">Memuat Kabupaten/Kota...</option>';

        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
            .then(res => res.json())
            .then(data => {
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                data.forEach(item => {
                    const option = new Option(item.name, item.name);
                    if (item.name.trim() === selectedKabupaten.trim()) {
                        option.selected = true;
                    }
                    kabupatenSelect.add(option);
                });
            })
            .catch(err => {
                console.error("Gagal memuat kabupaten:", err);
                kabupatenSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            });
    }
});
</script>


