<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('ticket_id')->unique();
            $table->unsignedInteger('circuit_id');
            $table->boolean('status')->default(0);
            $table->timestamp('time_opened');
            $table->timestamp('time_closed')->nullable();
            $table->unsignedInteger('rfo_id')->nullable();
            $table->unsignedInteger('pc_id')->nullable();
            $table->longText('rca')->nullable();
            $table->unsignedInteger('modified_by');
            $table->longText('comment')->nullable();
            $table->timestamps();

            $table->foreign('rfo_id')->references('id')->on('reason_for_outages')->onDelete('cascade');
            $table->foreign('pc_id')->references('id')->on('possible_causes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('circuit_id')->references('id')->on('circuits')->onDelete('cascade');
            $table->foreign('modified_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function(Blueprint $table){
            $table->dropForeign('tickets_rfo_id_foreign');
            $table->dropForeign('tickets_pc_id_foreign');
            $table->dropForeign('tickets_user_id_foreign');
            $table->dropForeign('tickets_circuit_id_foreign');
            $table->dropForeign('tickets_modified_by_foreign');
        });
    }
}
