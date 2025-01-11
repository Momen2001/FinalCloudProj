<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleHourInHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_hour_in_hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('work_schedule_id')->unsigned(); // id merchant
            $table->foreign('work_schedule_id')->references('id')->on('schedule_in_hospitals')->onDelete('cascade');
            $table->integer('hour');
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
        Schema::dropIfExists('schedule_hour_in_hospitals');
    }
}
