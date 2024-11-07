<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->char('nik', 5)->primary();          // Primary Key
            $table->string('nama_lengkap', 100);        // Menggunakan 'string' alih-alih 'varchar'
            $table->string('jabatan', 20);              // Menggunakan 'string' alih-alih 'varchar'
            $table->string('no_hp', 14);                // Menggunakan 'string' alih-alih 'varchar'
            $table->string('password', 255);            // Menggunakan 'string' alih-alih 'password'
            $table->string('foto', 30);            // Menggunakan 'string' alih-alih 'password'
            $table->string('remember_token', 255)->nullable(); // Kolom nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
