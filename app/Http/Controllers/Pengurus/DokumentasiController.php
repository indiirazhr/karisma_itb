<?php

namespace App\Http\Controllers\Pengurus;

use App\Models\Kegiatan;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::with('files', 'kegiatan')->latest()->get();
        return view('pengurus.dokumentasi.index', compact('dokumentasi'));
    }

    public function create()
    {
        $kegiatanList = Kegiatan::pluck('judul', 'id');
        return view('pengurus.dokumentasi.create', compact('kegiatanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'description' => 'required|string',
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,docx|max:5048'
        ]);

        // dd($request->all());


        $dokumentasi = Dokumentasi::create([
            'judul' => $request->judul,
            'kegiatan_id' => $request->kegiatan_id,
            'description' => $request->description,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = $file->store('dokumentasi_files', 'public');

                $dokumentasi->files()->create([
                    'file_path' => $filename
                ]);
            }
        }

        return redirect()->route('pengurus.dokumentasi.index')->with('success', 'Dokumentasi berhasil ditambahkan');
    }

    public function show(Dokumentasi $dokumentasi)
    {
        $dokumentasi->load('files', 'kegiatan'); // eager load relasi
        return view('pengurus.dokumentasi.show-image', compact('dokumentasi'));
    }

    public function exportPdf()
    {
        $dokumentasi = Dokumentasi::with(['kegiatan', 'files'])->get();

        $pdf = Pdf::loadView('pengurus.dokumentasi.pdf', compact('dokumentasi'));
        return $pdf->download('data-dokumentasi.pdf');
    }


}
