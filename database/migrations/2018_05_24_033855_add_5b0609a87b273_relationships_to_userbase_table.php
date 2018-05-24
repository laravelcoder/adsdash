<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0609a87b273RelationshipsToUserBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_bases', function(Blueprint $table) {
            if (!Schema::hasColumn('user_bases', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '163055_5b0609a33dc0a')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('user_bases', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '163055_5b0609a34eddb')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('user_bases', function(Blueprint $table) {
            
        });
    }
}
