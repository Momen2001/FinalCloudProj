<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceCompTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_comp_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('insurance_comp_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->unique(['insurance_comp_id', 'locale']);
            $table->foreign('insurance_comp_id')->references('id')->on('insurance_comps')->onDelete('cascade');
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
        Schema::dropIfExists('insurance_comp_translations');
    }
}
