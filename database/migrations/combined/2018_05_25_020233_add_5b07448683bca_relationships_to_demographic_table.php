<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b07448683bcaRelationshipsToDemographicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demographics', function(Blueprint $table) {
            if (!Schema::hasColumn('demographics', 'audience_id')) {
                $table->integer('audience_id')->unsigned()->nullable();
                $table->foreign('audience_id', '163046_5b0741565eb10')->references('id')->on('audiences')->onDelete('cascade');
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
        Schema::table('demographics', function(Blueprint $table) {
            if(Schema::hasColumn('demographics', 'audience_id')) {
                $table->dropForeign('163046_5b0741565eb10');
                $table->dropIndex('163046_5b0741565eb10');
                $table->dropColumn('audience_id');
            }
            
        });
    }
}
