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
        Schema::table('perniagaan', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['bandar']);
            $table->dropForeign(['negeri']);
            
            // Rename columns to follow Laravel conventions
            $table->renameColumn('bandar', 'bandar_id');
            $table->renameColumn('negeri', 'negeri_id');
            
            // Add back the foreign key constraints with new names
            $table->foreign('bandar_id')->references('id')->on('bandar')->onDelete('set null');
            $table->foreign('negeri_id')->references('id')->on('negeri')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perniagaan', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['bandar_id']);
            $table->dropForeign(['negeri_id']);
            
            // Rename columns back
            $table->renameColumn('bandar_id', 'bandar');
            $table->renameColumn('negeri_id', 'negeri');
            
            // Add back original foreign key constraints
            $table->foreign('bandar')->references('id')->on('bandar')->onDelete('set null');
            $table->foreign('negeri')->references('id')->on('negeri')->onDelete('set null');
        });
    }
};
