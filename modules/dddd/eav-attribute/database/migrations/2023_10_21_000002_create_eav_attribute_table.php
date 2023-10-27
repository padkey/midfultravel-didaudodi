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
        Schema::create('eav_attribute', function (Blueprint $table) {
            $table->increments('attribute_id');
            $table->text('attribute_default_name');
            $table->string('attribute_type', 255);
            $table->boolean('is_require');
            $table->boolean('is_system')->default(false);
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('eav_attribute_set', function (Blueprint $table) {
            $table->increments('attribute_set_id');
            $table->string('attribute_set_name', 255);
            $table->string('attribute_set_group', 255);
            $table->boolean('is_system')->default(false);
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('eav_attribute_group', function (Blueprint $table) {
            $table->increments('attribute_group_id');
            $table->string('attribute_group_name', 255);
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('eav_attribute_relation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_group_id')->unsigned();
            $table->foreign('attribute_group_id')->references('attribute_group_id')->on('eav_attribute_group');
            $table->integer('attribute_id')->unsigned();
            $table->foreign('attribute_id')->references('attribute_id')->on('eav_attribute');
        });

        Schema::create('eav_attribute_set_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_group_id')->unsigned();
            $table->foreign('attribute_group_id')->references('attribute_group_id')->on('eav_attribute_group');
            $table->integer('attribute_set_id')->unsigned();
            $table->foreign('attribute_set_id')->references('attribute_set_id')->on('eav_attribute_set');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eav_attribute');
        Schema::dropIfExists('eav_attribute_set');
        Schema::dropIfExists('eav_attribute_group');
        Schema::dropIfExists('eav_attribute_relation');
        Schema::dropIfExists('eav_attribute_set_group');
    }
};