<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHospitalMainServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_hospital_main_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hospital_id')->unsigned();
            $table->foreign('hospital_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('main_service_id')->unsigned();
            $table->foreign('main_service_id')->references('id')->on('main_services')->onDelete('cascade');
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
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
        Schema::dropIfExists('payment_hospital_main_services');
    }
}
