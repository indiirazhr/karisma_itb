<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pemesanan</title>
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
        .bg-warning { background-color: #ffc107; color: #000; }
        .bg-secondary { background-color: #6c757d; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Daftar Pemesanan</h3>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Pemesan</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->product->name ?? '-' }}</td>
                    <td class="text-center">{{ $order->jumlah }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <strong>{{ $order->nama_pemesan ?? $order->user->name ?? '-' }}</strong><br>
                        <small>{{ $order->email_pemesan ?? $order->user->email ?? '-' }}</small>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-{{ 
                            $order->status === 'dibayar' ? 'success' : 
                            ($order->status === 'selesai' ? 'secondary' : 'warning') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="text-center">{{ $order->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada pemesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
