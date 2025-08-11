<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    public function index(Request $request)
{
    $roles = Role::pluck('role', 'id');

    $users = User::with('role')
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        })
        ->when($request->filled('role'), function ($query) use ($request) {
            $query->where('role_id', $request->role);
        })
        ->orderBy('name')
        ->paginate(10);

    return view('admin.manajemen-user.index', compact('users', 'roles'));
}


    public function create()
    {
        $roles = Role::pluck('role', 'id');
        $divisis = Divisi::pluck('nama', 'id'); 
        return view('admin.manajemen-user.create', compact('roles', 'divisis'));
    }

   public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'role_id'   => 'required|exists:roles,id',
            'divisi_id' => 'required_if:role_id,2|nullable|exists:divisis,id',
            'password'  => 'required|string|min:6|confirmed',
        ], [
            'divisi_id.required_if' => 'Divisi wajib dipilih jika peran adalah Pengurus Divisi.',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
            'divisi_id' => $request->divisi_id,
        ]);

        return redirect()->route('admin.data-user.index')->with('success', 'User berhasil ditambahkan.');
    }


    public function edit(User $user)
    {
        $roles = Role::pluck('role', 'id');
        return view('admin.manajemen-user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role_id'   => 'required|exists:roles,id',
        ]);

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('admin.data-user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.data-user.index')->with('success', 'User berhasil dihapus.');
    }
}
