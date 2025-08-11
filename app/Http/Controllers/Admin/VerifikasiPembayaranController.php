<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembayaran;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VerifikasiPembayaranController extends Controller
{
    public function index()
    {
        $user = User::pluck('name', 'id'); // Ambil daftar user untuk dropdown
        $pembayaran = Pembayaran::with('user')->latest()->get();
        return view('admin.verifikasi-pembayaran.index', compact('pembayaran'));
    }

   public function updateStatus(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'status' => 'required|in:valid,tidak valid'
        ]);

        $pembayaran->status = $request->status;
        $pembayaran->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }


    public function exportPdf()
    {
        $pembayaran = Pembayaran::with('user')->latest()->get();

        $pdf = Pdf::loadView('admin.verifikasi-pembayaran.pdf', compact('pembayaran'))
                ->setPaper('a4', 'landscape');
                
        return $pdf->download('verifikasi-pembayaran.pdf');
    }

}
