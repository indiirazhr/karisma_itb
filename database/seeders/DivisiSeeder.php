<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divisi;

class DivisiSeeder extends Seeder
{
    public function run(): void
    {
        $divisis = [
            'Divisi Pendidikan',
            'Divisi Sosial',
            'Divisi Keuangan',
            'Divisi Kreatif',
            'Divisi Humas',
        ];

        foreach ($divisis as $divisi) {
            Divisi::create(['nama' => $divisi]);
        }
    }
}
