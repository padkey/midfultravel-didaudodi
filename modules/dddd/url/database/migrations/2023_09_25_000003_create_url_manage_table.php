<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Design database: https://dbdiagram.io/d/643506598615191cfa8ce3f5
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('url_manage')) {
            Schema::create('url_manage', function (Blueprint $table) {
                $table->id();
                $table->string('entity_type', 32);
                $table->integer('entity_id');
                $table->string('request_path', 255)->unique();
                $table->string('target_path', 255);
                $table->smallInteger('redirect_type');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_manage');
    }
};
