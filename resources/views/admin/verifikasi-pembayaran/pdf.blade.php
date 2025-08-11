<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #eee; }
        .text-center { text-align: center; }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            color: #fff;
        }
        .bg-success { background-color: #28a745; }
        .bg-danger { background-color: #dc3545; }
        .bg-warning { background-color: #ffc107; color: #000; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Verifikasi Pembayaran</h3>

    <table>
        <thead>
            <tr>
                <th>Nama Adik</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembayaran as $item)
                <tr>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ 
                            $item->status === 'valid' ? 'success' :
                            ($item->status === 'tidak valid' ? 'danger' : 'warning') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="text-center">{{ $item->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data pembayaran</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
