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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visit_no')->unique();
            $table->foreignId('visitor_id')->constrained('visitors')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('visit_date');
            $table->dateTime('time_out')->nullable();
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('badge_id')->constrained('badges')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->enum('visit_reason', ['Meeting', 'Event', 'Consultation', 'Delivery', 'Other'])->default('Meeting');
            $table->enum('visitor_status', ['Arrived', 'In', 'Out'])->default('In');
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('visits');
    }
};
