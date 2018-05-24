<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b06087b18a0cRelationshipsToDefaultSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('default_settings', function(Blueprint $table) {
            if (!Schema::hasColumn('default_settings', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '163047_5b060877eb760')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('default_settings', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '163047_5b06087808341')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('default_settings', function(Blueprint $table) {
            
        });
    }
}