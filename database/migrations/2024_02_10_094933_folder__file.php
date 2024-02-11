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
        Schema::create('folder_file_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folder_id')->constrained('folder_models');
            $table->foreignId('file_id')->constrained('file_models');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folder_file_pivot');
    }
};
