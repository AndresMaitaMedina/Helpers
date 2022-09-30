<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseOccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use_occs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('use_id');
            $table->unsignedBigInteger('ser_occ_id');
            $table->foreign('use_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ser_occ_id')->references('id')->on('service_occupations')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('use_occs');
    }
}
