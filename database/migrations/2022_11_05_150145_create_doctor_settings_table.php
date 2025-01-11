<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('doctor_id')->unsigned(); // id merchant
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('hospital_id')->unsigned(); // id merchant
            $table->foreign('hospital_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('emergency_online_price');
            $table->date('experience_start_work');
            $table->string('emergency_home_visit_price');
            $table->string('online_price');
            $table->string('home_visit_price');
            $table->string('in_hospital_price');
            $table->integer('can_work_emergency_online');
            $table->integer('can_work_emergency_home_visit');
            $table->integer('can_work_in_home_visit');
            $table->integer('can_work_in_hospital');
            $table->integer('can_work_online');
            $table->text('speciality');
            $table->text('speciality_en');
            $table->string('license');
            $table->text('bio')->nullable();
            $table->text('bio_en')->nullable();
            $table->text('education')->nullable();
            $table->text('experience')->nullable();
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
        Schema::dropIfExists('dorctor_settings');
    }
}
