<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalLocationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_location_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('hospital_location_id')->unsigned();
            $table->string('locale');
            $table->text('location');
            $table->unique(['hospital_location_id', 'locale'], 'hospital_loc_id_locale_unique');
            $table->foreign('hospital_location_id')->references('id')->on('hospital_locations')->onDelete('cascade');
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
        Schema::dropIfExists('hospital_location_translations');
    }
}
