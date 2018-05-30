<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0f324004cc8RelationshipsToAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function(Blueprint $table) {
            if (!Schema::hasColumn('agents', 'company_id')) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', '164212_5b08676cd58b5')->references('id')->on('contact_companies')->onDelete('cascade');
                }
                if (!Schema::hasColumn('agents', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '164212_5b08676ced506')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('agents', function(Blueprint $table) {
            if(Schema::hasColumn('agents', 'company_id')) {
                $table->dropForeign('164212_5b08676cd58b5');
                $table->dropIndex('164212_5b08676cd58b5');
                $table->dropColumn('company_id');
            }
            if(Schema::hasColumn('agents', 'created_by_team_id')) {
                $table->dropForeign('164212_5b08676ced506');
                $table->dropIndex('164212_5b08676ced506');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
