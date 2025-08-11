<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserApprove;
use Illuminate\Http\Request;

class UserApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingUsers = User::where('role_id', 4)->where('status', 0)->get();
        return view('admin.approve.index', compact('pendingUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function approve($id){
        $user = User::findOrFail($id);
         $user->status = 1;
         $user->save();

        //  dd($user);

        return back()->with('success', 'Akun warga berhasil disetujui.');
 
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserApprove $userApprove)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserApprove $userApprove)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserApprove $userApprove)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserApprove $userApprove)
    {
        //
    }
}
