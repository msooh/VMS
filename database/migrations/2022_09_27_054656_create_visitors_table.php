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
            $table->string('visitor_fname');
            $table->string('visitor_lname');
            $table->string('visitor_email');
            $table->integer('visitor_id_number');
            $table->integer('visitor_country_code');
            $table->integer('visitor_phone_number');
            $table->dateTime('visit_date');
            $table->dateTime('time_in');
            $table->dateTime('time_out');
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
