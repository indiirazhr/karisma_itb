<?php

namespace App\Http\Controllers\Pengurus;

use Illuminate\Http\Request;
use App\Models\LaporanDivisi;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LaporanDivisiController extends Controller
{
    /**
     * Menampilkan daftar laporan divisi milik pengurus (divisinya sendiri)
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // Ambil semua laporan berdasarkan divisi pengurus
        $laporan = LaporanDivisi::with('divisi')
            ->where('divisi_id', $user->divisi_id)
            ->when($request->bulan, fn($q) => $q->whereMonth('bulan', $request->bulan))
            ->when($request->tahun, fn($q) => $q->whereYear('bulan', $request->tahun))
            ->orderBy('bulan', 'desc')
            ->get();

        return view('pengurus.laporan-divisi.index', compact('laporan'));
    }

    /**
     * Form untuk menambah laporan divisi
     */
    public function create()
    {
        return view('pengurus.laporan-divisi.create');
    }

    /**
     * Simpan laporan divisi ke database
     */
   public function store(Request $request)
    {
        $request->validate([
            'jumlah_adik' => 'required|integer|min:0',
            'pemasukan' => 'required|numeric|min:0',
            'pengeluaran' => 'required|numeric|min:0',
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|digits:4',
            'keterangan' => 'nullable|string',
        ]);

        $user = auth()->user();

        // ✅ Validasi: Pengurus wajib punya divisi
        if ($user->role?->name === 'Pengurus Divisi' && !$user->divisi_id) {
            return back()->withErrors(['divisi' => 'User pengurus belum memiliki divisi.'])->withInput();
        }

        $dateBulan = \Carbon\Carbon::createFromDate($request->tahun, $request->bulan, 1)->startOfMonth();

        // Cek duplikasi laporan divisi
        $exists = LaporanDivisi::where('divisi_id', $user->divisi_id)
            ->whereDate('bulan', $dateBulan)
            ->exists();

        if ($exists) {
            return back()->withErrors(['bulan' => 'Laporan bulan ini sudah ada.'])->withInput();
        }

        // Simpan laporan
        LaporanDivisi::create([
            'divisi_id' => $user->divisi_id,
            'user_id' => $user->id,
            'bulan' => $dateBulan,
            'jumlah_adik' => $request->jumlah_adik,
            'pemasukan' => $request->pemasukan,
            'pengeluaran' => $request->pengeluaran,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengurus.laporan-divisi.index')->with('success', 'Laporan berhasil disimpan');
    }

    public function edit(LaporanDivisi $laporan)
    {
        $user = auth()->user();

        if ($laporan->divisi_id !== $user->divisi_id) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return view('pengurus.laporan-divisi.edit', compact('laporan'));
    }

    public function update(Request $request, LaporanDivisi $laporan)
        {
            $request->validate([
                'jumlah_adik' => 'required|integer|min:0',
                'pemasukan' => 'required|numeric|min:0',
                'pengeluaran' => 'required|numeric|min:0',
                'bulan' => 'required|integer|between:1,12',
                'tahun' => 'required|integer|digits:4',
                'keterangan' => 'nullable|string',
            ]);

            $user = auth()->user();
            if ($laporan->divisi_id !== $user->divisi_id) {
                abort(403, 'Akses tidak diizinkan.');
            }

            $laporan->update([
                'jumlah_adik' => $request->jumlah_adik,
                'pemasukan' => $request->pemasukan,
                'pengeluaran' => $request->pengeluaran,
                'bulan' => \Carbon\Carbon::createFromDate($request->tahun, $request->bulan, 1),
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('pengurus.laporan-divisi.index')->with('success', 'Laporan berhasil diperbarui.');
        }

    public function destroy(LaporanDivisi $laporan)
        {
            $user = auth()->user();
            if ($laporan->divisi_id !== $user->divisi_id) {
                abort(403, 'Akses tidak diizinkan.');
            }

            $laporan->delete();

            return redirect()->route('pengurus.laporan-divisi.index')->with('success', 'Laporan berhasil dihapus.');
        }


}
