<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class ListOrderConttroller extends Controller
{
      public function index(Request $request)
    {
        $query = Order::with(['user', 'product']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('email')) {
            $query->where(function ($q) use ($request) {
                $q->where('email_pemesan', 'like', '%' . $request->email . '%')
                  ->orWhereHas('user', function ($q2) use ($request) {
                      $q2->where('email', 'like', '%' . $request->email . '%');
                  });
            });
        }

        $orders = $query->latest()->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,dibayar,selesai',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function exportPdf()
    {
        $orders = Order::with(['user', 'product'])->latest()->get();

        $pdf = Pdf::loadView('admin.order.pdf', compact('orders'))->setPaper('a4', 'landscape');
        return $pdf->download('daftar-pemesanan.pdf');
    }

}
