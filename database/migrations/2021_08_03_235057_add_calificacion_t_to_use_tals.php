<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCalificacionTToUseTals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_tals', function (Blueprint $table) {
            $table->integer('calificacionT')->default(0)->after('imagen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('use_tals', function (Blueprint $table) {
            $table->dropColumn('calificacionT');
        });
    }
}
