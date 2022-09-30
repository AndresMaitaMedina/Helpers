<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseTalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use_tals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('use_id');
            $table->unsignedBigInteger('ser_tal_id');
            $table->foreign('use_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ser_tal_id')->references('id')->on('service_talent')->onDelete('cascade')->onUpdate('cascade');
            $table->text('descripcion');
            $table->decimal('precio', 6, 2);
            $table->string('imagen')->nullable();
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
        Schema::dropIfExists('use_tals');
    }
}
