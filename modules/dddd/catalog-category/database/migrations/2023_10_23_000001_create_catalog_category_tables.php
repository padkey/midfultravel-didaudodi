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
        Schema::create('catalog_category_entity', function (Blueprint $table) {
            $table->increments('entity_id');
            $table->string('category_name', 255)->nullable();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('category_path', 255)->nullable();
            $table->string('category_uri', 255)->nullable();
            $table->integer('position')->default(1)->nullable();
            $table->integer('level')->nullable();
            $table->integer('children_count')->default(0)->nullable();
            $table->integer('attribute_set_id')->unsigned()->nullable();
            $table->foreign('attribute_set_id')->references('attribute_set_id')->on('eav_attribute_set');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('catalog_category_value_entity', function (Blueprint $table) {
            $table->increments('value_id');
            $table->text('value')->nullable();
            $table->integer('entity_id')->unsigned();
            $table->foreign('entity_id')->references('entity_id')->on('catalog_category_entity');
            $table->integer('attribute_id')->unsigned();
            $table->foreign('attribute_id')->references('attribute_id')->on('eav_attribute');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('catalog_category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('entity_id')->on('catalog_category_entity');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('entity_id')->on('catalog_product_entity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_category_entity');
        Schema::dropIfExists('catalog_category_entity_common');
        Schema::dropIfExists('catalog_category_product');
    }
};
