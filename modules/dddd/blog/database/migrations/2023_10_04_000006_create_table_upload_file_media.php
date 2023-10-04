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
        Schema::create('upload_file_media', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->nullable();
            $table->string('url_file', 255);
            $table->string('file', 255);
            $table->string('url_key', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_file_media');
    }
};
