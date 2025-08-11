<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporan_divisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('divisi_id')->constrained('divisis')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->date('bulan'); 
            $table->integer('jumlah_adik');
            $table->decimal('pemasukan', 12, 2);
            $table->decimal('pengeluaran', 12, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['divisi_id', 'bulan']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_divisis');
    }
};

