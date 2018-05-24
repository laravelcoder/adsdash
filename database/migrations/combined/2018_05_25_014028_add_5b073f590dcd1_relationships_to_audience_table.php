<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b073f590dcd1RelationshipsToAudienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audiences', function(Blueprint $table) {
            if (!Schema::hasColumn('audiences', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '163045_5b0607c14db6f')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('audiences', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '163045_5b0607c15d896')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('audiences', function(Blueprint $table) {
            if(Schema::hasColumn('audiences', 'created_by_id')) {
                $table->dropForeign('163045_5b0607c14db6f');
                $table->dropIndex('163045_5b0607c14db6f');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('audiences', 'created_by_team_id')) {
                $table->dropForeign('163045_5b0607c15d896');
                $table->dropIndex('163045_5b0607c15d896');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
