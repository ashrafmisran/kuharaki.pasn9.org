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
        Schema::create('industri_perniagaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industri_id')->constrained('industri')->onDelete('cascade');
            $table->foreignId('perniagaan_id')->constrained('perniagaan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industri_perniagaan');
    }
};
