<?php

namespace App\Http\Controllers\Admin;

use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function index()
    {
       $programs = Program::with('category')->latest()->get(); // ← penting!
        $categories = Category::all();
        return view('admin.program.index', compact('programs', 'categories'));
    }

    public function create()
    {
            $categories = Category::all();
            return view('admin.program.create', compact('categories'));

    }

    public function store(Request $request)
    {
       $request->validate([
            'judul' => 'required|string|max:255',
            'batas_pendaftar'   => 'required',
            'waktu'     => 'required',
            'tanggal'   => 'required',
            'lokasi'    => 'required',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $path = $request->file('file')?->store('program_files', 'public');

        Program::create([
            'judul' => $request->judul,
            'batas_pendaftar'   => $request->batas_pendaftar,
            'waktu' => $request->waktu,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'file_path' => $path,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(Program $program)
    {
         $categories = Category::all();
         return view('admin.program.edit', compact('program', 'categories'));
    }

    public function update(Request $request, Program $program)
    {
         $request->validate([
            'judul' => 'required|string|max:255',
            'batas_pendaftar'   => 'required',
            'waktu'     => 'required',
            'tanggal'   => 'required',
            'lokasi'    => 'required',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('file')) {
            // optionally delete old file here
            $path = $request->file('file')->store('program_files', 'public');
            $program->file_path = $path;
        }

        $program->update([
            'judul' => $request->judul,
            'waktu' => $request->waktu,
            'batas_pendaftar'   => $request->batas_pendaftar,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'category_id' => $request->category_id,
        ]);

        $program->save();

        return redirect()->route('admin.program.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return back()->with('success', 'Program berhasil dihapus.');
    }

}
