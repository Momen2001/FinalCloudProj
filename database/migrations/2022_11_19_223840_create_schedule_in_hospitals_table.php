<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleInHospitalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_in_hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('doctor_id')->unsigned(); // id merchant
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('day_name');
            $table->boolean('active')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('schedule_in_hospitals');
    }
}
