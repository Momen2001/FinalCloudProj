<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTotalPriceInWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_patients', function (Blueprint $table) {
            $table->renameColumn('total_price', 'amount');
        });
    }

    public function down()
    {
        Schema::table('wallet_patients', function (Blueprint $table) {
            $table->renameColumn('total_price', 'amount');
        });
    }

}
