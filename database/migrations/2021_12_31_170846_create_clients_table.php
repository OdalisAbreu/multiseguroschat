<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('cardnumber')->nullable();
            $table->string('passportnumber')->nullable();
            $table->integer('nacionalidad');
            $table->string('phonenumber');
            $table->integer('province');
            $table->string('adrress')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->unique();
            $table->string('idConversacion')->nullable();
            $table->string('vista')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
