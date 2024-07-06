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
        Schema::create('data_user', function (Blueprint $table) {
            $table->id('Id_pendaftar');
            $table->string('Nm_pendaftar');
            $table->string('Alamat');
            $table->string('Jenis_kelamin');
            $table->string('No_hp');
            $table->string('Asal_sekolah');
            $table->string('Jurusan');
            $table->string('Tgl_lahir');
            $table->string('NISN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_user');
    }
};
