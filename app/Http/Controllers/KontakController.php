<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{

    public function index(Request $request)
    {
        $query = Kontak::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
                ->orWhere('subject', 'like', "%{$request->search}%");
        }

        $kontaks = $query->latest()->paginate(10);

        return view('admin.kontak.index', compact('kontaks'));
    }


    public function kirim(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        Kontak::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);


     return response('OK', 200);


    }
}

