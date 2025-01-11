<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectReasonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject_reason_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('reject_reason_id')->unsigned();
            $table->string('locale');
            $table->text('description');
            $table->unique(['reject_reason_id', 'locale']);
            $table->foreign('reject_reason_id')->references('id')->on('reject_reasons')->onDelete('cascade');
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
        Schema::dropIfExists('reject_reason_translations');
    }
}
