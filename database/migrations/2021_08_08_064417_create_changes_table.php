<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ser_occ_change')->unique();
            $table->string('cha_name')->nullable();
            $table->string('cha_video')->nullable();
            $table->integer('cha_count')->unsigned()->default(0);
            $table->boolean('cha_25_percent_active')->default(0);
            $table->boolean('cha_active')->default(1);
            $table->timestamp('cha_upload_video_date')->nullable();
            $table->foreign('ser_occ_change')->references('id')->on('use_occs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('changes');
    }
}
