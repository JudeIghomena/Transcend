<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_user', function (Blueprint $table) {
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('user_id');

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::table('ticket_user', function(Blueprint $table){
            $table->dropForeign('ticket_user_ticket_id_foreign');
            $table->dropForeign('ticket_user_user_id_foreign');
        });
        Schema::dropIfExists('ticket_user');
    }
}
