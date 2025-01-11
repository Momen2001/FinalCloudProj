<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsWalletToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('use_wallet')->default(0)->after('id');
            $table->float('wallet_deduction')->default(0)->after('id');
            $table->float('gateway_due_amount')->default(0)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('use_wallet'); // Ensures rollback works correctly
            $table->dropColumn('wallet_deduction'); // Ensures rollback works correctly
        });
    }
}
