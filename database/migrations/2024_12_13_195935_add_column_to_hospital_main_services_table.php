<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToHospitalMainServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hospital_main_services', function (Blueprint $table) {
            $table->integer('support_B2B')->default(1)->after('id');
            $table->integer('commission')->default(1)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hospital_main_services', function (Blueprint $table) {
            $table->dropColumn('support_B2B');
            $table->dropColumn('commission');
         });
    }
}
