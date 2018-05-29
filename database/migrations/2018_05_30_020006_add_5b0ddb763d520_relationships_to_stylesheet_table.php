<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0ddb763d520RelationshipsToStylesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stylesheets', function(Blueprint $table) {
            if (!Schema::hasColumn('stylesheets', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165762_5b0dd999d177a')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('stylesheets', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165762_5b0dd999e18ef')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('stylesheets', function(Blueprint $table) {
            
        });
    }
}
