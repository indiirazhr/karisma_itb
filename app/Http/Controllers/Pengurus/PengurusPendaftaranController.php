<?php

namespace App\Http\Controllers\Pengurus;

use App\Models\Program;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;


class PengurusPendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['user', 'program'])
            ->latest()
            ->get()
            ->groupBy('program_id'); 

        return view('pengurus.pendaftaran.index', compact('pendaftarans'));
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $pendaftaran->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();
        return back()->with('success', 'Pendaftaran berhasil dihapus.');
    }

    public function showByProgram($id)
    {
        $program = Program::with(['pendaftarans.user'])->findOrFail($id);
        return view('pengurus.pendaftaran.detail', compact('program'));
    }

    // public function exportPdf(Request $request, $id)
    // {
    //     $program = Program::with(['pendaftarans.user'])->findOrFail($id);

    //     $ttdNama = $request->input('ttd_nama', 'Pengurus Divisi');
    //     $ttdTanggal = $request->input('ttd_tanggal', now()->format('d M Y'));

    //     $pdf = Pdf::loadView('pengurus.pendaftaran.export_pdf', compact('program', 'ttdNama', 'ttdTanggal'));
    //     return $pdf->download('pendaftar-program-' . Str::slug($program->judul) . '.pdf');
    // }
    public function exportPdf(Request $request, $id)
{
    $program = Program::with(['pendaftarans.user'])->findOrFail($id);

   $ttdNama = $request->input('ttd_nama', 'Pengurus Divisi');
    $ttdTanggal = \Carbon\Carbon::parse($request->input('ttd_tanggal'))->format('d M Y');
    $ttdLokasi = $request->input('ttd_lokasi', 'Bandung');


   $pdf = Pdf::loadView('pengurus.pendaftaran.export_pdf', compact('program', 'ttdNama', 'ttdTanggal', 'ttdLokasi'));
    return $pdf->download('pendaftar-program-' . Str::slug($program->judul) . '.pdf');
}


}
