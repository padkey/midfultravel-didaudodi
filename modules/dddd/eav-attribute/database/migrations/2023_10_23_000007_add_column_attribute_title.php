<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('eav_attribute', function (Blueprint $table) {
            $table->string('attribute_title', 255)->nullable()->after('attribute_id');
        });
    }

    public function down()
    {
        Schema::table('eav_attribute', function (Blueprint $table) {
            $table->dropColumn('attribute_title');
        });
    }
};
