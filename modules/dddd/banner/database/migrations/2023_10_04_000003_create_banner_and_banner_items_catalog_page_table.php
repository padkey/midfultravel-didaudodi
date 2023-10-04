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
        if (!Schema::hasTable('banner')) {
            Schema::create('banner', function (Blueprint $table) {
                $table->id();
                $table->string('uuid', 255)->unique();
                $table->string('name', 255);
                $table->text('description')->nullable();
                $table->string('banner_type', 64)->default('home');
                $table->string('banner_style', 16)->default('image');
                $table->string('position', 16)->nullable();
                $table->jsonb('category_id')->nullable();

                $table->timestamps();
            });

            Schema::create('banner_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('banner_id');
                $table->foreign('banner_id')->references('id')->on('banner');
                $table->string('name', 255);
                $table->text('url');
                $table->boolean('is_active')->default(true);
                $table->dateTime('schedule_from', 0);
                $table->dateTime('schedule_to', 0);
                $table->integer('province_id')->default(0);
                $table->text('path_desktop');
                $table->text('path_mobile');
                $table->integer('priority');
                $table->timestamps();
            });
        }
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
        if (!Schema::hasTable('banner_page')) {
            Schema::create('banner_page', function (Blueprint $table) {
                $table->id();
                $table->foreignId('banner_id');
                $table->foreign('banner_id')->references('id')
                    ->on('banner')->onDelete('cascade');
                $table->foreignId('page_id');
                $table->foreign('page_id')
                    ->references('id')
                    ->on('pages')
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
        Schema::dropIfExists('banner');
        Schema::dropIfExists('banner_items');
        Schema::dropIfExists('banner_page');
        Schema::dropIfExists('banner_product');
        Schema::dropIfExists('banner_category');
    }
};
