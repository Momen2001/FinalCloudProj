<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleServicesHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_main_services_hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('hospital_id')->unsigned(); // id merchant
            $table->foreign('hospital_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('main_service_id')->unsigned();
            $table->foreign('main_service_id')->references('id')->on('main_services')->onDelete('cascade');
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
        Schema::dropIfExists('schedule_services_hospitals');
    }
}
