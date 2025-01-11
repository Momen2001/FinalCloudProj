<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalMainServiceLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_main_service_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('hospital_id')->unsigned();
            $table->foreign('hospital_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('main_service_id')->unsigned();
            $table->foreign('main_service_id')->references('id')->on('main_services')->onDelete('cascade');
            $table->string('lat');
            $table->string('lng');
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
        Schema::dropIfExists('hospital_main_service_locations');
    }
}
