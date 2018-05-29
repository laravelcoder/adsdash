<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0de1409411dRelationshipsToStylesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stylesheets', function(Blueprint $table) {
            if (!Schema::hasColumn('stylesheets', 'template_id')) {
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', '165762_5b0ddc04c682c')->references('id')->on('templates')->onDelete('cascade');
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
            if(Schema::hasColumn('stylesheets', 'template_id')) {
                $table->dropForeign('165762_5b0ddc04c682c');
                $table->dropIndex('165762_5b0ddc04c682c');
                $table->dropColumn('template_id');
            }
            
        });
    }
}
