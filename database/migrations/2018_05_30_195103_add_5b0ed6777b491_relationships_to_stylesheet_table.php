<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0ed6777b491RelationshipsToStylesheetTable extends Migration
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
            
        });
    }
}
