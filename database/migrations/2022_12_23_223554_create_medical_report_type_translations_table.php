<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalReportTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_type_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->unique(['report_type_id', 'locale']);
            $table->foreign('report_type_id')->references('id')->on('report_types')->onDelete('cascade');
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
        Schema::dropIfExists('medical_report_type_translations');
    }
}
