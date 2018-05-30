<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0f1e007d398RelationshipsToLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layouts', function(Blueprint $table) {
            if (!Schema::hasColumn('layouts', 'page_id')) {
                $table->integer('page_id')->unsigned()->nullable();
                $table->foreign('page_id', '166423_5b0f1dfd46b26')->references('id')->on('content_pages')->onDelete('cascade');
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
        Schema::table('layouts', function(Blueprint $table) {
            
        });
    }
}
