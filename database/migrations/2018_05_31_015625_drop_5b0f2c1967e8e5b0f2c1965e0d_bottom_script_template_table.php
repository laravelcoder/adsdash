<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b0f2c1967e8e5b0f2c1965e0dBottomScriptTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bottom_script_template');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('bottom_script_template')) {
            Schema::create('bottom_script_template', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('bottom_script_id')->unsigned()->nullable();
            $table->foreign('bottom_script_id', 'fk_p_165765_165761_templa_5b0f2b8cce6eb')->references('id')->on('bottom_scripts');
                $table->integer('template_id')->unsigned()->nullable();
            $table->foreign('template_id', 'fk_p_165761_165765_bottom_5b0f2b8ccdb8f')->references('id')->on('templates');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
