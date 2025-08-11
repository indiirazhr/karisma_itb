<?php

namespace App\Http\Controllers\Peserta;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('peserta.belanja.index', compact('products'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $total = $product->price * $request->jumlah;

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total,
            'status' => 'pending',
            'alamat' => $request->alamat,
        ]);

        $product->decrement('stock', $request->jumlah);

        return redirect()->route('Peserta.belanja.index')->with('success', 'Silakan Mengunggah Bukti Pembayaran');
    }

    public function riwayat()
    {
        $orders = Order::with('product')->where('user_id', Auth::id())->latest()->get();
        return view('peserta.belanja.riwayat', compact('orders'));
    }
}

