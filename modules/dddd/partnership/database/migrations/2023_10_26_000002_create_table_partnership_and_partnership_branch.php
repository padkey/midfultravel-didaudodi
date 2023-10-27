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
        Schema::create('partnership', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
            $table->string('url', 255);
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('locale_code', 50)->nullable();

            $table->timestamps();
        });
        Schema::create('partnership_branch', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('url', 255);
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('partnership_id')->unsigned();
            $table->foreign('partnership_id')->references('id')->on('partnership');
            $table->string('locale_code', 50)->nullable();

            $table->timestamps();
        });
        Schema::create('tour_partnership_branch', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partnership_branch_id');
            $table->integer('tour_id')->unsigned();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnership');
        Schema::dropIfExists('partnership_branch');
        Schema::dropIfExists('tour_partnership_branch');

    }
};
