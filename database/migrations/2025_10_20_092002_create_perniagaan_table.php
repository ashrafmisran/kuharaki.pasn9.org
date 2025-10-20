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
        Schema::create('perniagaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('alamat_baris_1');
            $table->string('alamat_baris_2')->nullable();
            $table->integer('poskod');
            $table->foreignId('bandar')->constrained('bandar')->onDelete('set null');
            $table->foreignId('negeri')->constrained('negeri')->onDelete('set null');
            $table->enum('kategori',['fizikal','atas talian','hibrid']);
            $table->string('no_telefon')->nullable();
            $table->string('emel')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perniagaan');
    }
};
