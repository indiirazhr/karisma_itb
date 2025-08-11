<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function riwayat()
{
    $pembayarans = Pembayaran::where('user_id', Auth::id())->latest()->get();

    return view('peserta.pembayaran.riwayat-pembayaran', compact('pembayarans'));
}
      public function create()
    {
        return view('peserta.pembayaran.upload-pembayaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1',
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

       Pembayaran::create([
        'user_id' => Auth::id(), // ✅ benar
        'nominal' => $request->nominal,
        'bukti_transfer' => $path,
        'status' => 'pending',
    ]);


        return redirect()->route('Peserta.pembayaran.create')->with('success', 'Bukti pembayaran berhasil dikirim.');
    }

}
