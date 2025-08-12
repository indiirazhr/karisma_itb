<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dokumentasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Data Dokumentasi</h3>

    <table>
        <thead>
            <tr>
                <th>Tanggal Kegiatan</th>
                <th>Judul</th>
                <th>Kegiatan</th>
                <th>Deskripsi</th>
                <th>Jumlah File</th>
              
            </tr>
        </thead>
        <tbody>
            @forelse ($dokumentasi as $item)
                <tr>
                     <td>{{ $item->kegiatan->tanggal ?? '-' }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->kegiatan->judul ?? '-' }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->files->count() }} file</td>
                   
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
