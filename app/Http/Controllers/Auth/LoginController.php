<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated($request, $user)
    {
        // Cek apakah role_id 4 (warga)
        if ($user->role_id == 4) {
            if ($user->status == 1) {
                return redirect('/dashboard');
            } else {
                Auth::logout();
                return redirect('/verification/pending');
            }
        }

        // Selain role_id 4 langsung ke dashboard
        return redirect('/dashboard');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
