<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0dcdfb03ba9RelationshipsToAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function(Blueprint $table) {
            if (!Schema::hasColumn('ads', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '163042_5b06039011f83')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('ads', 'clip_id')) {
                $table->integer('clip_id')->unsigned()->nullable();
                $table->foreign('clip_id', '163042_5b0dcdf806d1d')->references('id')->on('clipdbs')->onDelete('cascade');
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
        Schema::table('ads', function(Blueprint $table) {
            
        });
    }
}
