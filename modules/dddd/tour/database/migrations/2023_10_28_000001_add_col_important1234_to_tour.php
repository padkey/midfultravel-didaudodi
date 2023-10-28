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

        Schema::table('tour', function (Blueprint $table) {
            $table->text('trip_highlights')->nullable();
            $table->string('image_trip_highlights', 255)->nullable();
            $table->text('place_overview')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour', function (Blueprint $table) {
            $table->dropColumn('trip_highlights');
            $table->dropColumn('image_trip_highlights');
            $table->dropColumn('place_overview');
        });
    }
};
