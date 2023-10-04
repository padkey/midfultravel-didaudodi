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
        Schema::create('block', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('image_one', 255)->nullable();;
            $table->string('image_two', 255)->nullable();;
            $table->string('type', 50)->nullable();
            $table->text('code')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block');
    }
};
