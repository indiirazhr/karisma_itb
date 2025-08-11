<?php

namespace App\Http\Controllers\Pembina;

use App\Models\AmalYaumi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class amalyaumireadController extends Controller
{
    public function index()
    {
        $amalYaumi = AmalYaumi::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role_id', 4); 
            })
            ->get(); 

        return view('pembina.amalyaumi', compact('amalYaumi'));
    }
}
