<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleHourServicesHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_hour_main_services_hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_main_services_hospital_id')->unsigned();
            $table->foreign('schedule_main_services_hospital_id', 'sched_man_serv_hospital')->references('id')->on('schedule_main_services_hospitals')->onDelete('cascade');
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
        Schema::dropIfExists('schedule_hour_services_hospitals');
    }
}
