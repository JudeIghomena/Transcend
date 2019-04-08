<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('client_id');
            $table->string('circuit_id')->nullable();
            $table->string('circuit_name')->unique();
            $table->string('service_order_number')->nullable();
            $table->boolean('status')->default(2);
            $table->date('provisioned')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('vlan')->nullable();
            $table->longText('ip_address')->nullable();
            $table->string('bandwidth')->nullable();
            $table->text('slug')->nullable();
            $table->unsignedInteger('modified_by');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::table('circuits', function(Blueprint $table)
        {
            $table->dropForeign('circuits_user_id_foreign');
            $table->dropForeign('circuits_client_id_foreign');
            $table->dropForeign('circuits_modified_by_foreign');
        });

        Schema::drop('circuits');
    }
}
