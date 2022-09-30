<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamesToServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_occs', function (Blueprint $table) {
            $table->string('ser_occ_name',50)->default('Reparador de computadoras')->after('ser_occ_id');
        });
        Schema::table('use_tals', function (Blueprint $table) {
            $table->string('ser_tal_name',50)->default('Abridor de cajas')->after('ser_tal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('use_occs', function (Blueprint $table) {
            $table->dropColumn('ser_occ_name');
        });
        Schema::table('use_tals', function (Blueprint $table) {
            $table->dropColumn('ser_tal_name');
        });
    }
}
