<?php

namespace App\Http\Controllers\Pengurus;

use App\Models\User;
use App\Models\Raport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RaportController extends Controller
{
    
    public function index()
        {
            // Ambil rapor yang hanya terkait dengan user dengan role_id = 4 (atau peserta)
            $rapors = Raport::with('user')
                ->whereHas('user', function($query) {
                    $query->where('role_id', 4); // Misalnya role_id 4 adalah "peserta"
                })
                ->get();

            return view('pengurus.raport.index', compact('rapors'));
        }

   public function create()
    {
        // Ambil data user dengan role_id = 4 (misalnya role_id 4 adalah "adik")
        $adiks = User::where('role_id', 4)->get();  // Ambil adik dengan role_id 4
        return view('pengurus.raport.create', compact('adiks'));  // Kirim data ke view
    }


    public function store(Request $request)
        {
            // Validasi input
            $request->validate([
                'user_id' => 'required|exists:users,id', // Validasi user_id
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file
            ]);

            // Simpan file
            $filePath = $request->file('file')->store('rapors', 'public');  // Simpan di 'storage/app/public/rapors'

            // Simpan data rapor
            Raport::create([
                'user_id' => $request->user_id,
                'file_path' => $filePath,
            ]);

            return redirect()->route('pengurus.raport.index')->with('success', 'Rapor berhasil diupload.');
        }
        
    public function show(Raport $raport)
    {
        // Menampilkan file rapor yang diupload
        return response()->file(storage_path('app/public/' . $raport->file_path));
    }

    public function destroy(Raport $raport)
    {
        Storage::delete('public/' . $raport->file_path);

        $raport->delete();

        return redirect()->route('pengurus.raport.index')->with('success', 'Rapor berhasil dihapus.');
    }


}
