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
        Schema::create('tour_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('sub_title', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('position', 255)->nullable();
            $table->integer('tour_id');
            $table->timestamps();
        });
        Schema::table('tour', function (Blueprint $table) {
            $table->text('important_information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_schedule');
        Schema::table('tour', function (Blueprint $table) {
            $table->dropColumn('important_information');
        });
    }
};
