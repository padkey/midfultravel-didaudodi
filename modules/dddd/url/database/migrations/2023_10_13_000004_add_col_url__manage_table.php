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
        Schema::table('url_manage', function (Blueprint $table) {
            $table->dropUnique(['request_path']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('url_manage');
    }
};
