<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('eav_attribute_group', function (Blueprint $table) {
            $table->string('uid');
            $table->boolean('is_system')->after('attribute_group_name')->default(false);
        });
    }

    public function down()
    {
        Schema::table('eav_attribute_group', function (Blueprint $table) {
            $table->dropColumn('uid');
            $table->dropColumn('is_system');
        });
    }

};
