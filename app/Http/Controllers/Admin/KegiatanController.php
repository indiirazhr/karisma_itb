<?php

namespace App\Http\Controllers\Admin;


use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KegiatanController extends Controller
{
     public function index()
    {
        return view('admin.kegiatan.index');
    }

    public function fetchEvents()
    {
        $events = Kegiatan::select('id', 'judul as title', 'tanggal as start', 'deskripsi')->get();
        return response()->json($events);
    }


   public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        Kegiatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json(['message' => 'Kegiatan berhasil ditambahkan']);
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $kegiatan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json(['message' => 'Kegiatan berhasil diperbarui']);
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return response()->json(['message' => 'Kegiatan berhasil dihapus']);
    }
}
