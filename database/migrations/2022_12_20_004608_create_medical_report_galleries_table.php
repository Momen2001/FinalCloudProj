<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalReportGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_report_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medical_report_id')->unsigned()->nullable();
            $table->foreign('medical_report_id')->references('id')->on('medical_reports')->onDelete('cascade');
            $table->text('name');
            $table->text('file_name');
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
        Schema::dropIfExists('medical_report_galleries');
    }
}
