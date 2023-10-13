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
        if (!Schema::hasTable('locale')) {
            Schema::create('locale', function (Blueprint $table) {
                $table->id();
                $table->string('name', 50)->nullable();
                $table->string('code', 50)->nullable();
                $table->timestamps();
            });
        }
        if (Schema::hasTable('blog_post')) {
            Schema::table('blog_post', function($table) {
                $table->string('locale_code', 50)->nullable();
               // $table->unique('locale_code','url');

            });
        }
        if (Schema::hasTable('video')) {
            Schema::table('video', function($table) {
                $table->string('locale_code', 50)->nullable();
              //  $table->unique('locale_code','url_key');
            });
        }
        if (Schema::hasTable('tour')) {
            Schema::table('tour', function($table) {
                $table->string('locale_code', 50)->nullable();
               // $table->unique('locale_code','url');

            });
        }
        if (Schema::hasTable('companion')) {
            Schema::table('companion', function($table) {
                $table->string('locale_code', 50)->nullable();
               // $table->unique('locale_code','url_key');
            });
        }
        if (Schema::hasTable('block')) {
            Schema::table('block', function($table) {
                $table->string('locale_code', 50)->nullable();
              //  $table->unique('locale_code','code');
            });
        }
        if (Schema::hasTable('blog_category')) {
            Schema::table('blog_category', function($table) {
                $table->string('locale_code', 50)->nullable();
               // $table->unique('locale_code','code');
            });
        }
        if (Schema::hasTable('pages')) {
            Schema::table('pages', function($table) {
                $table->string('locale_code', 50)->nullable();
                // $table->unique('locale_code','code');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locale');

    }
};
