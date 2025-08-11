<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('amal_yaumi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');  
        $table->enum('sholat_5_waktu', ['ya', 'tidak', 'halangan'])->nullable();  
        $table->enum('sholat_dhuha', ['ya', 'tidak'])->nullable();  
        $table->enum('qiyamul_lail', ['ya', 'tidak'])->nullable();  
        $table->enum('puasa_sunnah', ['ya', 'tidak'])->nullable();  
        $table->enum('tilawah', ['ya', 'tidak'])->nullable();  
        $table->enum('membaca_buku', ['ya', 'tidak'])->nullable();  
        $table->enum('membantu_orang_tua', ['ya', 'tidak'])->nullable();  
        $table->enum('mengerjakan_tugas', ['ya', 'tidak'])->nullable();  
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amal_yaumi');
    }
};
