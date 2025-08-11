<?php

namespace App\Http\Controllers\Pengurus;
use App\Models\AmalYaumi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmalYaumiController extends Controller
{
       /**
     * Menampilkan data Amal Yaumi dari peserta
     */
  public function index()
    {
        $amalYaumi = AmalYaumi::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role_id', 4); 
            })
            ->get(); 

        return view('pengurus.amal-yaumi-adik.index', compact('amalYaumi'));
    }
    

}
