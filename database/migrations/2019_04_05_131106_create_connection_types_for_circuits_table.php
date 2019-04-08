<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionTypesForCircuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_types_for_circuits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('circuit_id')->unique()->nullable(); // circuit_id
            $table->unsignedInteger('connection_id')->nullable();
            $table->timestamps();
            $table->foreign('circuit_id')->references('id')->on('circuits')->onDelete('cascade');
            $table->foreign('connection_id')->references('id')->on('connections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('connection_types_for_circuits', function (Blueprint $table) {
            $table->dropForeign('connection_types_for_circuits_connection_id_foreign');
            $table->dropForeign('connection_types_for_circuits_circuit_id_foreign');
        });

        Schema::drop('connection_types_for_circuits');
    }
}
