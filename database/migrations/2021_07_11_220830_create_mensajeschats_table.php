<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajeschatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajeschats', function (Blueprint $table) {
            $table->id();
            $table->text('mensaje');
            $table->integer('cliente');
            $table->integer('vendedor');
            $table->integer('envia');
            $table->timestamps();
            $table->integer('id_servicio');
            $table->text('servicio')->nullable();
            $table->date('fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajeschats');
    }
}
