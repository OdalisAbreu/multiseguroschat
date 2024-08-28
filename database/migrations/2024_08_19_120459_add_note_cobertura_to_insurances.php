<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoteCoberturaToInsurances extends Migration
{
    public function up()
    {
        Schema::table('insurances', function (Blueprint $table) {
            $table->text('note_cobertura')->nullable()->after('color');
        });
    }
    public function down()
    {
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropColumn('note_cobertura');
        });
    }
}
