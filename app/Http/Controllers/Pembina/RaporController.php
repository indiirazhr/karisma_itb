<?php

namespace App\Http\Controllers\Pembina;

use App\Models\Raport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RaporController extends Controller
{
     public function index()
        {
            $rapors = Raport::with('user')
                ->whereHas('user', function($query) {
                    $query->where('role_id', 4); // Misalnya role_id 4 adalah "peserta"
                })
                ->get();

            return view('pembina.rapor', compact('rapors'));
        }
}
