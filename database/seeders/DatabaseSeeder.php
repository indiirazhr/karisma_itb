<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'role'  => 'Admin'
        ]);
        Role::create([
            'role'  => 'Pengurus Divisi'
        ]);
        Role::create([
            'role'  => 'Pembina'
        ]);
        Role::create([
            'role'  => 'Peserta'
        ]);

        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@karisma.itb.com',
            'password'  => bcrypt('admin123'),
            'role_id'   => 1
        ]);
         User::create([
            'name'      => 'Pengurus Divisi',
            'email'     => 'pengurus.divisi@karisma.itb.com',
            'password'  => bcrypt('pengurus123'),
            'role_id'   => 2
        ]);
         User::create([
            'name'      => 'Pembina',
            'email'     => 'pembina01@karisma.itb.com',
            'password'  => bcrypt('pembina123'),
            'role_id'   => 3
        ]);
         User::create([
            'name'      => 'Adik Mentoring',
            'email'     => 'adik01@karisma.itb.com',
            'password'  => bcrypt('adik123'),
            'role_id'   => 4
        ]);
    
         $this->call([
            DivisiSeeder::class,
        ]);
    }
}
