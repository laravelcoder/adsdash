<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b08689f061baRelationshipsToClipdbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clipdbs', function(Blueprint $table) {
            if (!Schema::hasColumn('clipdbs', 'ad_id')) {
                $table->integer('ad_id')->unsigned()->nullable();
                $table->foreign('ad_id', '164207_5b0861787edce')->references('id')->on('ads')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clipdbs', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '164207_5b0861788dff3')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clipdbs', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '164207_5b0861789c916')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('clipdbs', function(Blueprint $table) {
            if(Schema::hasColumn('clipdbs', 'ad_id')) {
                $table->dropForeign('164207_5b0861787edce');
                $table->dropIndex('164207_5b0861787edce');
                $table->dropColumn('ad_id');
            }
            if(Schema::hasColumn('clipdbs', 'created_by_id')) {
                $table->dropForeign('164207_5b0861788dff3');
                $table->dropIndex('164207_5b0861788dff3');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('clipdbs', 'created_by_team_id')) {
                $table->dropForeign('164207_5b0861789c916');
                $table->dropIndex('164207_5b0861789c916');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}