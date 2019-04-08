<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircuitRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuit_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('circuit_id_fk');
            $table->text('circuit_remark');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('circuit_id_fk')->references('id')->on('circuits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('circuit_remarks', function(Blueprint $table){
            $table->dropForeign('circuit_remarks_user_id_foreign');
            $table->dropForeign('circuit_remarks_circuit_id_fk_foreign');
        });
        Schema::dropIfExists('circuit_remarks');
    }
}
