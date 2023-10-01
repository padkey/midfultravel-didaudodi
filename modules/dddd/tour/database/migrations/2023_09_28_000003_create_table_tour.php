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
        if (!Schema::hasTable('tour')) {
            Schema::create('tour', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('image', 255)->nullable();
                $table->string('image_thumbnail', 255)->nullable();
                $table->text('short_description')->nullable();
                $table->text('content')->nullable();
                $table->string('url', 255);
                $table->tinyInteger('is_active')->default(1);
                $table->dateTime('date_end');
                $table->dateTime('date_start');
                $table->string('type_tour', 255)->nullable();
                $table->string('meta_title', 255);
                $table->string('meta_keywords', 255);
                $table->string('meta_description', 255);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
