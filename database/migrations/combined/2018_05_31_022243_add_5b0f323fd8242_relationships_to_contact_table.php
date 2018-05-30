<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0f323fd8242RelationshipsToContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function(Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'company_id')) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', '163015_5b05f82bc15d8')->references('id')->on('contact_companies')->onDelete('cascade');
                }
                if (!Schema::hasColumn('contacts', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '163015_5b0866ef225b0')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('contacts', function(Blueprint $table) {
            if(Schema::hasColumn('contacts', 'company_id')) {
                $table->dropForeign('163015_5b05f82bc15d8');
                $table->dropIndex('163015_5b05f82bc15d8');
                $table->dropColumn('company_id');
            }
            if(Schema::hasColumn('contacts', 'created_by_team_id')) {
                $table->dropForeign('163015_5b0866ef225b0');
                $table->dropIndex('163015_5b0866ef225b0');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
