<?php

namespace App\Http\Controllers\Peserta;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AmalYaumi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class amalyaumipesertaController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $data = AmalYaumi::where('user_id', Auth::id())->whereDate('created_at', $today)->first();

        return view('peserta.amal-yaumi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sholat_5_waktu' => 'required|in:ya,tidak,halangan',
            'sholat_dhuha' => 'required|in:ya,tidak',
            'qiyamul_lail' => 'required|in:ya,tidak',
            'puasa_sunnah' => 'required|in:ya,tidak',
            'tilawah' => 'required|in:ya,tidak',
            'membaca_buku' => 'required|in:ya,tidak',
            'membantu_orang_tua' => 'required|in:ya,tidak',
            'mengerjakan_tugas' => 'required|in:ya,tidak',
        ]);

        AmalYaumi::updateOrCreate(
            ['user_id' => Auth::id(), 'created_at' => Carbon::today()],
            $request->only([
                'sholat_5_waktu', 'sholat_dhuha', 'qiyamul_lail', 'puasa_sunnah',
                'tilawah', 'membaca_buku', 'membantu_orang_tua', 'mengerjakan_tugas'
            ]) + ['user_id' => Auth::id()]
        );

        return redirect()->route('Peserta.amal-yaumi.index')->with('success', 'Amal Yaumi hari ini telah disimpan.');
    }
}
