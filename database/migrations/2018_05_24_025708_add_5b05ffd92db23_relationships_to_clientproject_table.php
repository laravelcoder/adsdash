<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b05ffd92db23RelationshipsToClientProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_projects', function(Blueprint $table) {
            if (!Schema::hasColumn('client_projects', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '163032_5b05ffd619a18')->references('id')->on('clients')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_projects', 'project_status_id')) {
                $table->integer('project_status_id')->unsigned()->nullable();
                $table->foreign('project_status_id', '163032_5b05ffd627e83')->references('id')->on('client_project_statuses')->onDelete('cascade');
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
        Schema::table('client_projects', function(Blueprint $table) {
            
        });
    }
}
