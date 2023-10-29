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
            $table->text('important_info_1')->nullable();
            $table->text('important_info_2')->nullable();
            $table->text('important_info_3')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour', function (Blueprint $table) {
            $table->dropColumn('important_info_1');
            $table->dropColumn('important_info_2');
            $table->dropColumn('important_info_3');
        });
    }
};
