<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0de3a17addfRelationshipsToProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('providers', function(Blueprint $table) {
            if (!Schema::hasColumn('providers', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '163808_5b07384f67dd8')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('providers', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '163808_5b07384f7ff41')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('providers', function(Blueprint $table) {
            if(Schema::hasColumn('providers', 'created_by_id')) {
                $table->dropForeign('163808_5b07384f67dd8');
                $table->dropIndex('163808_5b07384f67dd8');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('providers', 'created_by_team_id')) {
                $table->dropForeign('163808_5b07384f7ff41');
                $table->dropIndex('163808_5b07384f7ff41');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
