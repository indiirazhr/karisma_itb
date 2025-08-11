<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
     public function index()
    {
        $dokumentasi = Dokumentasi::with('files')->latest()->get(); 

        return view('pages.dokumentasi.index', compact('dokumentasi'));
    }
}
