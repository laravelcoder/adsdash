<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0f3240d7ef1NetworkProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('network_provider')) {
            Schema::create('network_provider', function (Blueprint $table) {
                $table->integer('network_id')->unsigned()->nullable();
                $table->foreign('network_id', 'fk_p_163806_163808_provid_5b0f3240d7fe0')->references('id')->on('networks')->onDelete('cascade');
                $table->integer('provider_id')->unsigned()->nullable();
                $table->foreign('provider_id', 'fk_p_163808_163806_networ_5b0f3240d80af')->references('id')->on('providers')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_provider');
    }
}
