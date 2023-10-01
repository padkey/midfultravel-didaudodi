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
        if (!Schema::hasTable('banner_page')) {
            Schema::create('banner_page', function (Blueprint $table) {
                $table->id();
                $table->foreignId('banner_id');
                $table->foreign('banner_id')->references('id')
                    ->on('banner')->onDelete('cascade');
                $table->foreignId('page_id');
                $table->foreign('page_id')
                    ->references('id')
                    ->on('pages')
                    ->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_page');
    }
};
