<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataPaymentGateway extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_payment_gateway', function (Blueprint $table) {
            $table->id();
            $table->string('merchanttype');
            $table->string('merchantnumber');
            $table->string('merchantterminal');
            $table->string('client_name');


            //FK
            $table->integer('insurance_id');
            $table->foreign('insurance_id')->references('id')->on('insurances');
            $table->integer('payment_gateway_id');

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
        //
    }
}
