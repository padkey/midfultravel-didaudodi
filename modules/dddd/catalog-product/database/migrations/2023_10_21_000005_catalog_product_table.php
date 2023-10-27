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
        if (!Schema::hasTable('catalog_product_entity')) {
            Schema::create('catalog_product_entity', function (Blueprint $table) {
                $table->increments('entity_id');
                $table->string('product_name', 255)->nullable();
                $table->string('sku', 255)->unique();
                $table->integer('attribute_set_id')->unsigned();
                $table->foreign('attribute_set_id')->references('attribute_set_id')->on('eav_attribute_set');
                $table->string('product_type', 255);
                $table->string('product_uri', 255)->unique()->nullable();
                $table->integer('dddd_id')->nullable();
                $table->integer('parent_dddd_id')->nullable();
                $table->string('default_value')->nullable();
                $table->boolean('status')->default(true);
                $table->timestamps();
                $table->softDeletes()->nullable();
            });

            Schema::create('catalog_product_relation', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned();
                $table->foreign('parent_id')->references('entity_id')->on('catalog_product_entity');
                $table->integer('child_id')->unsigned();
                $table->foreign('child_id')->references('entity_id')->on('catalog_product_entity');
            });

            Schema::create('catalog_product_entity_decimal', function (Blueprint $table) {
                $table->increments('value_id');
                $table->decimal('value', 12, 4)->nullable();
                $table->integer('entity_id')->unsigned();
                $table->foreign('entity_id')->references('entity_id')->on('catalog_product_entity');
                $table->integer('attribute_id')->unsigned();
                $table->foreign('attribute_id')->references('attribute_id')->on('eav_attribute');
                $table->timestamps();
                $table->softDeletes()->nullable();
            });

            Schema::create('catalog_product_entity_datetime', function (Blueprint $table) {
                $table->increments('value_id');
                $table->dateTime('value')->nullable();
                $table->integer('entity_id')->unsigned();
                $table->foreign('entity_id')->references('entity_id')->on('catalog_product_entity');
                $table->integer('attribute_id')->unsigned();
                $table->foreign('attribute_id')->references('attribute_id')->on('eav_attribute');
                $table->timestamps();
                $table->softDeletes()->nullable();
            });

            Schema::create('catalog_product_entity_int', function (Blueprint $table) {
                $table->increments('value_id');
                $table->integer('value')->nullable();
                $table->integer('entity_id')->unsigned();
                $table->foreign('entity_id')->references('entity_id')->on('catalog_product_entity');
                $table->integer('attribute_id')->unsigned();
                $table->foreign('attribute_id')->references('attribute_id')->on('eav_attribute');
                $table->timestamps();
                $table->softDeletes()->nullable();
            });

            Schema::create('catalog_product_entity_text', function (Blueprint $table) {
                $table->increments('value_id');
                $table->text('value')->nullable();
                $table->integer('entity_id')->unsigned();
                $table->foreign('entity_id')->references('entity_id')->on('catalog_product_entity');
                $table->integer('attribute_id')->unsigned();
                $table->foreign('attribute_id')->references('attribute_id')->on('eav_attribute');
                $table->timestamps();
                $table->softDeletes()->nullable();
            });

            Schema::create('catalog_product_entity_varchar', function (Blueprint $table) {
                $table->increments('value_id');
                $table->string('value', 255)->nullable();
                $table->integer('entity_id')->unsigned();
                $table->foreign('entity_id')->references('entity_id')->on('catalog_product_entity');
                $table->integer('attribute_id')->unsigned();
                $table->foreign('attribute_id')->references('attribute_id')->on('eav_attribute');
                $table->timestamps();
                $table->softDeletes()->nullable();
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_product_entity');
        Schema::dropIfExists('catalog_product_relation');
        Schema::dropIfExists('catalog_product_entity_decimal');
        Schema::dropIfExists('catalog_product_entity_datetime');
        Schema::dropIfExists('catalog_product_entity_int');
        Schema::dropIfExists('catalog_product_entity_text');
        Schema::dropIfExists('catalog_product_entity_varchar');
    }
};
