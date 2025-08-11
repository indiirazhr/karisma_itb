<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Program;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan halaman pendaftaran program untuk peserta
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::with('program')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peserta.pendaftaran-program.index', compact('pendaftarans'));
    }

    /**
     * Tampilkan semua program untuk didaftarkan
     */
    public function listProgram()
    {
        // Ambil semua program
        $programs = Program::all();

        // Ambil program yang sudah pernah didaftar user
        $sudahDaftar = Pendaftaran::where('user_id', auth()->id())->pluck('program_id')->toArray();

        return view('peserta.pendaftaran-program.list', compact('programs', 'sudahDaftar'));
    }

    /**
     * Simpan pendaftaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'alasan' => 'nullable|string|max:500',
        ]);

        // Cek duplikasi
        $exists = Pendaftaran::where('user_id', auth()->id())
            ->where('program_id', $request->program_id)
            ->exists();

        if ($exists) {
            return redirect()->route('pendaftaran-program.index')->with('warning', 'Kamu sudah mendaftar ke program ini.');
        }

        // Ambil data program
        $program = Program::findOrFail($request->program_id);

        // Hitung jumlah pendaftar untuk program ini
        $jumlahPendaftar = Pendaftaran::where('program_id', $program->id)->count();

        // Cek apakah sudah melebihi batas
        if ($jumlahPendaftar >= $program->batas_pendaftar) {
            return redirect()->route('pendaftaran-program.index')->with('error', 'Kuota program sudah penuh.');
        }

        // Simpan pendaftaran
        Pendaftaran::create([
            'user_id' => auth()->id(),
            'program_id' => $request->program_id,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);

        return redirect()->route('Peserta.pendaftaran-program.index')->with('success', 'Berhasil mendaftar program.');
    }
}
