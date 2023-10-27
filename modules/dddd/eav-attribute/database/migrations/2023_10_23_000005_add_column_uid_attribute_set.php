<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('eav_attribute_set', function (Blueprint $table) {
            $table->string('uid')->unique()->after('attribute_set_id');
        });
        Schema::table('eav_attribute_set', function (Blueprint $table) {
            $table->unique(['uid', 'attribute_set_group']);
        });
    }

    public function down()
    {
        Schema::table('eav_attribute_set', function (Blueprint $table) {
            $table->dropColumn('uid');
        });
        Schema::table('eav_attribute_set', function (Blueprint $table) {
            $table->dropUnique('eav_attribute_set_uid_attribute_set_group_unique');
        });
    }

};
