<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eav_attribute_value', function (Blueprint $table) {
            $table->increments('id');
            $table->text('value');
            $table->integer('attribute_id');
            $table->foreign('attribute_id')->references('attribute_id')->on('eav_attribute');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eav_attribute_value');
    }
};