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
        if (!Schema::hasTable('blog_category')) {
            Schema::create('blog_category', function (Blueprint $table) {
                $table->id();
                $table->string('title', 255);
                $table->text('image_banner')->nullable();
                $table->string('image_thumbnail', 255)->nullable();
                $table->string('meta_title', 255);
                $table->string('meta_keywords', 255);
                $table->string('meta_description', 255);
                $table->text('short_description')->nullable();
                $table->text('content')->nullable();
                $table->string('url', 255);
                $table->smallInteger('position');
                $table->integer('parent_id');
                $table->string('path_level', 50)->nullable();
                $table->tinyInteger('is_active')->default(1);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('blog_post')) {
            Schema::create('blog_post', function (Blueprint $table) {
                $table->id();
                $table->string('title', 255);
                $table->string('image_banner', 255)->nullable();
                $table->string('image_thumbnail', 255)->nullable();
                $table->string('meta_title', 255);
                $table->string('meta_keywords', 255);
                $table->string('meta_description', 255);
                $table->text('short_description')->nullable();
                $table->text('content')->nullable();
                $table->string('url', 255);
                $table->integer('author_id');
                $table->tinyInteger('is_active')->default(1);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('blog_post_category_relation')) {
            Schema::create('blog_post_category_relation', function (Blueprint $table) {
                $table->id();
                $table->foreignId('blog_category_id');
                $table->foreign('blog_category_id')
                    ->references('id')
                    ->on('blog_category')
                    ->onDelete('cascade');
                $table->foreignId('blog_post_id');
                $table->foreign('blog_post_id')
                    ->references('id')
                    ->on('blog_post')
                    ->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('blog_post_related_post')) {
            Schema::create('blog_post_related_post', function (Blueprint $table) {
                $table->id();
                $table->foreignId('blog_post_id');
                $table->foreign('blog_post_id')
                    ->references('id')
                    ->on('blog_post')
                    ->onDelete('cascade');
                $table->foreignId('related_id');
                $table->foreign('related_id')
                    ->references('id')
                    ->on('blog_post')
                    ->onDelete('cascade');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post_category_relation');
        Schema::dropIfExists('blog_post_related_post');
        Schema::dropIfExists('blog_category');
        Schema::dropIfExists('blog_post');
    }
};