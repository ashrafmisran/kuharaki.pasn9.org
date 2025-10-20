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
        Schema::create('produk_servis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('perniagaan_id')->constrained('perniagaan')->onDelete('cascade');
            $table->enum('jenis', ['produk', 'servis']);
            $table->text('keterangan')->nullable();
            $table->decimal('harga', 15, 2);
            $table->enum('kategori_harga',['tetap', 'bermula dari'])->default('tetap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_servis');
    }
};
