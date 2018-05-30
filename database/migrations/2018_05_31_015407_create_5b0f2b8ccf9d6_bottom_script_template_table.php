<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0f2b8ccf9d6BottomScriptTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('bottom_script_template')) {
            Schema::create('bottom_script_template', function (Blueprint $table) {
                $table->integer('bottom_script_id')->unsigned()->nullable();
                $table->foreign('bottom_script_id', 'fk_p_165765_165761_templa_5b0f2b8ccfad4')->references('id')->on('bottom_scripts')->onDelete('cascade');
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', 'fk_p_165761_165765_bottom_5b0f2b8ccfb6a')->references('id')->on('templates')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bottom_script_template');
    }
}
