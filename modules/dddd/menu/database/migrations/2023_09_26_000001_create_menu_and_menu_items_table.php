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
        if (!Schema::hasTable('menu')) {
            Schema::create('menu', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->text('description')->nullable();
                $table->string('menu_key', 50)->unique()->nullable();
                $table->string('menu_type', 50)->nullable();
                $table->string('display_style', 50)->nullable();
                $table->integer('display_order')->default(1);
                $table->timestamps();
            });

            Schema::create('menu_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('menu_id');
                $table->foreign('menu_id')->references('id')->on('menu');

                $table->string('name', 255);
                $table->text('url');
                $table->string('type', 32)->default('item');

                $table->string('image')->nullable();
                $table->string('icon')->nullable();
                $table->string('color')->nullable();

                $table->integer('parent_id');
                $table->text('path_level')->nullable();
                $table->integer('position')->default(0);
                $table->string('target_attr', 50)->nullable();
                $table->boolean('is_use_label_on_mobile')->default(false);

                $table->timestamps();
            });
        }
        if (!Schema::hasTable('menu_category')) {
            Schema::create('menu_category', function (Blueprint $table) {
                $table->id();
                $table->foreignId('menu_id');
                $table->foreign('menu_id')
                    ->references('id')
                    ->on('menu')
                    ->onDelete('cascade');
                $table->foreignId('category_id');
                // $table->foreign('category_id')
                //     ->references('entity_id')
                //     ->on('catalog_category_entity')
                //     ->onDelete('cascade');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('menu_page')) {
            Schema::create('menu_page', function (Blueprint $table) {
                $table->id();
                $table->foreignId('menu_id');
                $table->foreign('menu_id')->references('id')
                    ->on('menu')->onDelete('cascade');
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
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('menu_category');
        Schema::dropIfExists('menu_page');

    }
};
