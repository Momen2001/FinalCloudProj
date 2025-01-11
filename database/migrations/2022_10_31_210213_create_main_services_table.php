<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('main_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('is_urgent')->default(0);
//            $table->string('type');
            $table->integer('status')->default(1);
            $table->string('photo')->nullable();
            $table->string('scenario_develop')->nullable();
            $table->string('filter_develop')->nullable();
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
        Schema::dropIfExists('main_services');
    }
}
