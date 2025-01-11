<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainServiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_service_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->unique(['main_service_id', 'locale']);
            $table->foreign('main_service_id')->references('id')->on('main_services')->onDelete('cascade');
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
        Schema::dropIfExists('main_service_translations');
    }
}
