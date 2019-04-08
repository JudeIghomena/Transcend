<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('client_name')->unique();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('modified_by');
            $table->longText('address')->nullable();
            $table->boolean('status')->default(1);
            $table->string('phone')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->text('slug')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('clients', function(Blueprint $table){
            $table->dropForeign('clients_user_id_foreign');
            $table->dropForeign('clients_modified_by_foreign');
        });

        Schema::dropIfExists('clients');
    }
}
