<?php

namespace App\Http\Controllers\Public;

use App\Models\Product;
use App\Models\Dokumentasi;
use App\Http\Controllers\Controller;

class DokumentasiPublikController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::with('files')->latest()->get();
        $products = Product::where('stock', '>', 0)->get();
        return view('index', compact('dokumentasi', 'products'));
    }
}
