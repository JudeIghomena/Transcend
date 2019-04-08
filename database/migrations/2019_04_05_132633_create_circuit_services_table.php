<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircuitServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuit_service', function (Blueprint $table)
        {
            $table->unsignedInteger('circuit_id')->index();
            $table->unsignedInteger('service_id')->index();

            $table->foreign('circuit_id')->references('id')->on('circuits')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

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
        Schema::table('circuit_service', function(Blueprint $table){
            $table->dropForeign('circuit_service_circuit_id_foreign');
            $table->dropForeign('circuit_service_service_id_foreign');
        });
        Schema::dropIfExists('circuit_service');
    }
}
