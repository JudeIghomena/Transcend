<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentNotificationTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ema::create('incident_notification_templates', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('modified_by');
            $table->string('int_title')->unique();
            $table->text('int_template');
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
        Schema::table('incident_notification_templates', function(Blueprint $table){
            $table->dropForeign('incident_notification_templates_user_id_foreign');
            $table->dropForeign('incident_notification_templates_modified_by_foreign');
        });
        Schema::dropIfExists('incident_notification_templates');
    }
}
