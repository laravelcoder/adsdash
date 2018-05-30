<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0ddfd3a9fbaRelationshipsToBottomScriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bottom_scripts', function(Blueprint $table) {
            if (!Schema::hasColumn('bottom_scripts', 'template_id')) {
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', '165765_5b0ddfd083e67')->references('id')->on('templates')->onDelete('cascade');
                }
                if (!Schema::hasColumn('bottom_scripts', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165765_5b0ddfd096129')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('bottom_scripts', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165765_5b0ddfd0a62c5')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('bottom_scripts', function(Blueprint $table) {
            
        });
    }
}
