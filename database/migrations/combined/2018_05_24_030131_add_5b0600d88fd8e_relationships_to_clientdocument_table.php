<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0600d88fd8eRelationshipsToClientDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_documents', function(Blueprint $table) {
            if (!Schema::hasColumn('client_documents', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '163034_5b05ffe992f4f')->references('id')->on('client_projects')->onDelete('cascade');
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
        Schema::table('client_documents', function(Blueprint $table) {
            if(Schema::hasColumn('client_documents', 'project_id')) {
                $table->dropForeign('163034_5b05ffe992f4f');
                $table->dropIndex('163034_5b05ffe992f4f');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
