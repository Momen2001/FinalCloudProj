<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalMainServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_main_services', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('hospital_id')->unsigned();
            $table->foreign('hospital_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('main_service_id')->unsigned();
            $table->foreign('main_service_id')->references('id')->on('main_services')->onDelete('cascade');
            $table->integer('can_work_out_side')->default(1);
            $table->integer('time_before_receiving')->default(0); // if 0 the hospital make order directly
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
        Schema::dropIfExists('hospital_main_services');
    }
}
