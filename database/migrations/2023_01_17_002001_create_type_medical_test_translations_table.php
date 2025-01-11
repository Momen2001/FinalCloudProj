<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeMedicalTestTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medical_type_id')->unsigned();
            $table->string('locale');
            $table->text('title');
            $table->unique(['medical_type_id', 'locale']);
            $table->foreign('medical_type_id', 'tymed')->references('id')->on('medical_types');
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
        Schema::dropIfExists('type_medical_test_translations');
    }
}
