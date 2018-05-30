<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0f21797ceeaRelationshipsToLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layouts', function(Blueprint $table) {
            if (!Schema::hasColumn('layouts', 'template_id')) {
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', '166423_5b0f217655fc0')->references('id')->on('templates')->onDelete('cascade');
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
