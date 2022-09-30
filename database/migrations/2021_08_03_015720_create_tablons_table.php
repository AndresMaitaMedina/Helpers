<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablons', function (Blueprint $table) {
            $table->id();
            $table->text('servicio');
            $table->text('descripcion');
            $table->decimal('precio', 6, 2);
            $table->text('tipo');
            $table->integer('use_id');
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
        Schema::dropIfExists('tablons');
    }
}
