<?php

namespace App\Http\Controllers\Peserta;

use App\Models\Raport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RaportPesertaController extends Controller
{
    public function index()
    {
        $rapors = Raport::where('user_id', Auth::id())->latest()->get();

        return view('peserta.rapor.index', compact('rapors'));
    }

      public function show(Raport $raport)
    {
        // Menampilkan file rapor yang diupload
        return response()->file(storage_path('app/public/' . $raport->file_path));
    }
}
