<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        date_default_timezone_get();
        date_default_timezone_set('America/Lima');
        date('Y-m-d H:i:s');    

        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->dateTime('con_contract_date');
            $table->time('con_hour',4);
            $table->text('con_address')->require();
            $table->text('con_description')->require();
            $table->double('con_price',6,2);
            $table->dateTime('con_initial')->default(Carbon::now());
            $table->dateTime('con_end')->nullable();
            $table->unsignedBigInteger('use_offer');
            $table->unsignedBigInteger('use_receive');
            $table->unsignedBigInteger('use_occ_id')->nullable();
            $table->unsignedBigInteger('use_tal_id')->nullable();
            $table->string('con_status')->nullable();
            $table->foreign('use_offer')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('use_receive')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('use_occ_id')->references('id')->on('use_occs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('use_tal_id')->references('id')->on('use_tals')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('contracts');
    }
}
