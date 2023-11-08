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
        if (!Schema::hasTable('tour_enquire')) {
            Schema::create('tour_enquire', function (Blueprint $table) {
                $table->increments('id');
                $table->string('customer_name',255);
                $table->string('customer_phone',255);
                $table->string('customer_email',255);
                $table->text('customer_message');
                $table->string('status');
                $table->integer('tour_id');

                $table->text('admin_note')->nullable();
                $table->text('response_message_to_email')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_enquire');
    }
};
