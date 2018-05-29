<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0de4377c606RelationshipsToTopScriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_scripts', function(Blueprint $table) {
            if (!Schema::hasColumn('top_scripts', 'template_id')) {
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', '165773_5b0de13b2dd3e')->references('id')->on('templates')->onDelete('cascade');
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
        Schema::table('top_scripts', function(Blueprint $table) {
            if(Schema::hasColumn('top_scripts', 'template_id')) {
                $table->dropForeign('165773_5b0de13b2dd3e');
                $table->dropIndex('165773_5b0de13b2dd3e');
                $table->dropColumn('template_id');
            }
            
        });
    }
}
