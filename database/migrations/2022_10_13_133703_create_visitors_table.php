<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');
            $table->string('visitor_email');
            $table->integer('visitor_id_number');
            $table->integer('visitor_country_code');
            $table->integer('visitor_phone_number');
            $table->dateTime('visit_date');
            $table->datetime('time_in');
            $table->datetime('time_out');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->string('avatar',300)->nullable();
            $table->foreignId('badge_id')->constrained('badges')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('visitor_status', ['In', 'Out']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
};
