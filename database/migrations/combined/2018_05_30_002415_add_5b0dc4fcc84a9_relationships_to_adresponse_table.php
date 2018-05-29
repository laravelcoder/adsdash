<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0dc4fcc84a9RelationshipsToAdResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_responses', function(Blueprint $table) {
            if (!Schema::hasColumn('ad_responses', 'station_id')) {
                $table->integer('station_id')->unsigned()->nullable();
                $table->foreign('station_id', '163820_5b074c4da67b4')->references('id')->on('stations')->onDelete('cascade');
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
        Schema::table('ad_responses', function(Blueprint $table) {
            if(Schema::hasColumn('ad_responses', 'station_id')) {
                $table->dropForeign('163820_5b074c4da67b4');
                $table->dropIndex('163820_5b074c4da67b4');
                $table->dropColumn('station_id');
            }
            
        });
    }
}
