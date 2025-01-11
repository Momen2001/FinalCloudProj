<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectReasonOrderTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject_reason_order_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('reject_reason_order_id')->unsigned();
            $table->string('locale');
            $table->text('description');
            // Providing a shorter name for the unique constraint
            $table->unique(['reject_reason_order_id', 'locale'], 'rro_id_locale_unique');
            $table->foreign('reject_reason_order_id')->references('id')->on('reject_reason_orders')->onDelete('cascade');
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
        Schema::dropIfExists('reject_reason_order_translations');
    }
}
