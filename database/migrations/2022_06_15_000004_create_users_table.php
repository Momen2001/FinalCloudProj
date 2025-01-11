<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('first_name_en')->nullable();
            $table->string('last_name_en')->nullable();
            $table->text('provider_name_ar')->nullable();
            $table->text('provider_name_en')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone');
            $table->string('intro');
            $table->bigInteger('role_id')->unsigned();
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->integer('insurance_comp_id')->unsigned()->nullable();
            $table->foreign('insurance_comp_id')->references('id')->on('insurance_comps');
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('active')->default(1);
            $table->string('photo')->nullable();
            $table->string('code')->nullable();
            $table->integer('trust_phone')->default(0);
            $table->text('medical_history')->nullable();
            $table->string('confirm_condition')->nullable();
            $table->text('passport_id')->nullable();
            $table->text('fcm_notification')->nullable();
            $table->integer('status_notification')->default(1);
            $table->string('platform');
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('verified')->default(0)->nullable();
            $table->datetime('verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->boolean('two_factor')->default(0)->nullable();
            $table->string('two_factor_code')->nullable();
            $table->string('remember_token')->nullable();
            $table->datetime('two_factor_expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }


}
