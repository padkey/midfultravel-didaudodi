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
        Schema::create('tour_companion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('companion_id');
            $table->integer('tour_id')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_companion', function (Blueprint $table) {
            $table->dropColumn('companion_id');
            $table->dropColumn('tour_id');
        });
    }
};
