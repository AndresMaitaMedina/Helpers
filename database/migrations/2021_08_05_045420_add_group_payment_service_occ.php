<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddGroupPaymentServiceOcc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_occs', function (Blueprint $table) {
            $table->boolean('use_occ_group_payment')->default(false)->after('imagen');
            $table->decimal('precio_actual',6,2)->nullable()->unsigned()->after('imagen');
            // Add the constraint

        });
        DB::statement('ALTER TABLE use_occs ADD CONSTRAINT check_changes_actual_meta_precio CHECK (precio_actual <= precio);');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
