<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id');
            $table->bigInteger('hospital_id')->unsigned()->nullable();
            $table->foreign('hospital_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('owner_patient_id')->unsigned();
            $table->foreign('owner_patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->integer('main_service_id')->unsigned();
            $table->foreign('main_service_id')->references('id')->on('main_services')->onDelete('cascade');
            $table->string('booking_date');
            $table->string('booking_day_en');
            $table->string('booking_hour');
            $table->text('rejected_reason')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total')->nullable();
            $table->string('vat')->nullable();
            $table->string('vat_value')->nullable();
            $table->string('order_type')->nullable();
            $table->integer('status');
            $table->string('use_insurance');
            $table->text('comment')->nullable();
            $table->dateTime('reminded_at')->nullable();
            $table->integer('insurance_company_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
