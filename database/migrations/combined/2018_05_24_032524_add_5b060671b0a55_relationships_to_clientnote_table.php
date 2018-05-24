<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b060671b0a55RelationshipsToClientNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_notes', function(Blueprint $table) {
            if (!Schema::hasColumn('client_notes', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '163033_5b05ffdfce4a3')->references('id')->on('client_projects')->onDelete('cascade');
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
        Schema::table('client_notes', function(Blueprint $table) {
            if(Schema::hasColumn('client_notes', 'project_id')) {
                $table->dropForeign('163033_5b05ffdfce4a3');
                $table->dropIndex('163033_5b05ffdfce4a3');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
