<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wallet_id')->unsigned();
            $table->foreign('wallet_id')->references('id')->on('wallet_patients')->onDelete('cascade');
            $table->integer('is_recharge')->default(0);
            $table->string('payment_reference')->nullable();
            $table->string('status_transaction')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('description')->nullable();
            $table->string('currency');
            $table->float('amount');
            $table->enum('type', ['-', '+'])->default('+');
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
        Schema::dropIfExists('transaction_wallets');
    }
}
