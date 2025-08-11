<?php

namespace App\Http\Controllers\Public;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicOrderController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'jumlah' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $total = $product->price * $request->jumlah;

      Order::create([
        'product_id' => $product->id,
        'jumlah' => $request->jumlah,
        'total_harga' => $total,
        'status' => 'pending',
        'nama_pemesan' => $request->nama,
        'email_pemesan' => $request->email,
        'alamat' => $request->alamat,
]);


        $product->decrement('stock', $request->jumlah);

        return back()->with('success', 'Pesanan berhasil dikirim. Silakan tunggu konfirmasi.');
    }
}
