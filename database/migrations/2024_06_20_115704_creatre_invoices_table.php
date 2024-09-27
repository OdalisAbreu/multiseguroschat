<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatreInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('policyTime');
            $table->string('chassis');
            $table->string('licensePlate');
            $table->integer('year');
            $table->string('client_id');
            $table->string('payment_status');
            $table->double('totalGeneral')->nullable();
            $table->integer('sellers_id')->nullable();
            $table->integer('car_tipe')->nullable();
            $table->integer('car_brand')->nullable();
            $table->integer('car_model')->nullable();
            $table->string('services')->nullable();
            $table->string('tranf_number')->nullable();
            $table->string('card_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_ip')->nullable();
            $table->integer('discount_id')->default(0);
            $table->string('payment_messeger')->nullable();
            $table->string('auth_trans_ref_no')->nullable();
            $table->string('police_transactionId')->nullable();
            $table->string('police_number')->nullable();
            $table->string('RemoteResponseCode')->nullable();
            $table->string('AuthorizationCode')->nullable();
            $table->string('policyInitDate')->nullable();
            $table->string('RetrivalReferenceNumber')->nullable();
            $table->string('TxToken')->nullable();
            $table->string('imagenPoliza')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
