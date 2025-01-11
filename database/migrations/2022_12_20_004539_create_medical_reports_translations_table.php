<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalReportsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_report_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medical_report_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->text('description');
            $table->unique(['medical_report_id', 'locale']);
            $table->foreign('medical_report_id')->references('id')->on('medical_reports')->onDelete('cascade');
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
        Schema::dropIfExists('medical_reports_translations');
    }
}
