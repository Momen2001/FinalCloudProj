<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('education_id')->unsigned();
            $table->string('locale');
            $table->text('details');
            $table->text('degree');
            $table->text('specialization');
            $table->text('department');
            $table->text('university');
            $table->unique(['education_id', 'locale']);
            $table->foreign('education_id','eduId')->references('id')->on('educations');
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
        Schema::dropIfExists('education_translations');
    }
}
