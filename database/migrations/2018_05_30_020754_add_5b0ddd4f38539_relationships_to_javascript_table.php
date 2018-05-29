<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0ddd4f38539RelationshipsToJavascriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('javascripts', function(Blueprint $table) {
            if (!Schema::hasColumn('javascripts', 'template_id')) {
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', '165763_5b0ddd4bdbb8c')->references('id')->on('templates')->onDelete('cascade');
                }
                if (!Schema::hasColumn('javascripts', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165763_5b0ddd4bec240')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('javascripts', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165763_5b0ddd4c07805')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('javascripts', function(Blueprint $table) {
            
        });
    }
}
