<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0de1405f826RelationshipsToClipdbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clipdbs', function(Blueprint $table) {
            if (!Schema::hasColumn('clipdbs', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '164207_5b0861788dff3')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clipdbs', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '164207_5b0861789c916')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('clipdbs', function(Blueprint $table) {
            if(Schema::hasColumn('clipdbs', 'created_by_id')) {
                $table->dropForeign('164207_5b0861788dff3');
                $table->dropIndex('164207_5b0861788dff3');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('clipdbs', 'created_by_team_id')) {
                $table->dropForeign('164207_5b0861789c916');
                $table->dropIndex('164207_5b0861789c916');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
