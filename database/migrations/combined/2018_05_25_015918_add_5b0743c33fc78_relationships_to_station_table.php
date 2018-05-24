<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0743c33fc78RelationshipsToStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stations', function(Blueprint $table) {
            if (!Schema::hasColumn('stations', 'provider_id')) {
                $table->integer('provider_id')->unsigned()->nullable();
                $table->foreign('provider_id', '163809_5b07393277ff1')->references('id')->on('providers')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stations', function(Blueprint $table) {
            if(Schema::hasColumn('stations', 'provider_id')) {
                $table->dropForeign('163809_5b07393277ff1');
                $table->dropIndex('163809_5b07393277ff1');
                $table->dropColumn('provider_id');
            }
            
        });
    }
}
