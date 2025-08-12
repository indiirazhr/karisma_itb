<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pendaftar Program</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        .ttd-container {
            margin-top: 50px;
            width: 100%;
        }
        .ttd-kanan {
            width: 250px;
            float: right;
            text-align: center;
        }
        .ttd-space {
            height: 80px;
        }
    </style>
</head>
<body>
    <h2>Laporan Program: {{ $program->judul }}</h2>
    <h3>
    Waktu Pelaksanaan: 
    {{ \Carbon\Carbon::parse($program->tanggal . ' ' . $program->waktu)->translatedFormat('d F Y H:i') }}
    
</h3>
<h3>
    Akhir Pelaksanaan : 
    {{ \Carbon\Carbon::parse($program->tanggal_berakhir . ' ' . $program->waktu_berakhir)->translatedFormat('d F Y H:i') }}

</h3>

    <h3>Lokasi : {{$program->lokasi}}</h3>
    <h3>Jumlah Peserta : {{$program->pendaftarans->count()}}</h3>
    <h3>Jumlah Peserta hadir: {{$program->pendaftarans()
    ->whereHas('presensi')
    ->count();}}</h3>

    <h3>Deskripsi :</h3>
    <p>{{$program->deskripsi}}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>WA</th>
                <th>Sekolah</th>
                <th>Kehadiran</th>
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
                <td>
                    @if($item->presensi)
                    hadir
                    @else
                    Tidak hadir
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

<table style="width: 100%; margin-top: 50px; border: none;">
    <tr>
        <td style="width: 60%; border: none;"></td>
        <td style="width: 40%; text-align: center; border: none;">
            {{ $ttdLokasi }}, {{ $ttdTanggal }}<br>
            {{ $ttdNama }}<br><br><br><br><br>
            __________________________
        </td>
    </tr>
</table>


</body>
</html>
