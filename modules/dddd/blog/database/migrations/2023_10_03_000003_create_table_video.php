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
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->text('content')->nullable();;
            $table->string('image_thumbnail', 255);
            $table->tinyInteger('is_active')->nullable();
            $table->string('url_video', 255);
            $table->string('url_key', 255)->nullable();
            $table->string('author', 255)->nullable();
            $table->string('meta_title', 255);
            $table->string('meta_keywords', 255);
            $table->string('meta_description', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
