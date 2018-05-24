<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0744866db15RelationshipsToAdTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_types', function(Blueprint $table) {
            if (!Schema::hasColumn('ad_types', 'ad_id')) {
                $table->integer('ad_id')->unsigned()->nullable();
                $table->foreign('ad_id', '163043_5b0743be7f35c')->references('id')->on('ads')->onDelete('cascade');
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
        Schema::table('ad_types', function(Blueprint $table) {
            if(Schema::hasColumn('ad_types', 'ad_id')) {
                $table->dropForeign('163043_5b0743be7f35c');
                $table->dropIndex('163043_5b0743be7f35c');
                $table->dropColumn('ad_id');
            }
            
        });
    }
}
