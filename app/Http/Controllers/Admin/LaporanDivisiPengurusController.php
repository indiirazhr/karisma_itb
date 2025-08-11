<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LaporanDivisi;
use App\Http\Controllers\Controller;

class LaporanDivisiPengurusController extends Controller
{
     public function index(Request $request)
    {
        $user = auth()->user();

        // Ambil semua laporan berdasarkan divisi pengurus
        $laporan = LaporanDivisi::with('divisi')
            ->when(auth()->user()->role?->name === 'Pengurus Divisi', function ($query) {
                $query->where('divisi_id', auth()->user()->divisi_id);
            })
            ->when($request->bulan, fn($q) => $q->whereMonth('bulan', $request->bulan))
            ->when($request->tahun, fn($q) => $q->whereYear('bulan', $request->tahun))
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.laporan-divisi.index', compact('laporan'));
    }
}
