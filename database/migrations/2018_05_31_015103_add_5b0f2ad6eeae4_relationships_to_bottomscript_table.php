<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0f2ad6eeae4RelationshipsToBottomScriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bottom_scripts', function(Blueprint $table) {
            if (!Schema::hasColumn('bottom_scripts', 'template_id')) {
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', '165765_5b0ddfd083e67')->references('id')->on('templates')->onDelete('cascade');
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
        Schema::table('bottom_scripts', function(Blueprint $table) {
            
        });
    }
}
