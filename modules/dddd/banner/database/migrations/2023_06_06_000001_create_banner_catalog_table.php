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
        if (!Schema::hasTable('banner_product')) {
            Schema::create('banner_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('banner_id');
                $table->foreign('banner_id')->references('id')
                    ->on('banner')->onDelete('cascade');
                $table->foreignId('product_id');
                $table->foreign('product_id')
                    ->references('entity_id')
                    ->on('catalog_product_entity')
                    ->onDelete('cascade');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('banner_category')) {
            Schema::create('banner_category', function (Blueprint $table) {
                $table->id();
                $table->foreignId('banner_id');
                $table->foreign('banner_id')
                    ->references('id')
                    ->on('banner')
                    ->onDelete('cascade');
                $table->foreignId('category_id');
                $table->foreign('category_id')
                    ->references('entity_id')
                    ->on('catalog_category_entity')
                    ->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_product');
        Schema::dropIfExists('banner_category');
    }
};
