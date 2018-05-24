<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0609fef2739RelationshipsToClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function(Blueprint $table) {
            if (!Schema::hasColumn('clients', 'client_status_id')) {
                $table->integer('client_status_id')->unsigned()->nullable();
                $table->foreign('client_status_id', '163031_5b05ffcc6023e')->references('id')->on('client_statuses')->onDelete('cascade');
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
        Schema::table('clients', function(Blueprint $table) {
            if(Schema::hasColumn('clients', 'client_status_id')) {
                $table->dropForeign('163031_5b05ffcc6023e');
                $table->dropIndex('163031_5b05ffcc6023e');
                $table->dropColumn('client_status_id');
            }
            
        });
    }
}
