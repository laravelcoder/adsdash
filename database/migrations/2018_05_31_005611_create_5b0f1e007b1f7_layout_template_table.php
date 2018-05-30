<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0f1e007b1f7LayoutTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('layout_template')) {
            Schema::create('layout_template', function (Blueprint $table) {
                $table->integer('layout_id')->unsigned()->nullable();
                $table->foreign('layout_id', 'fk_p_166423_165761_templa_5b0f1e007b308')->references('id')->on('layouts')->onDelete('cascade');
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', 'fk_p_165761_166423_layout_5b0f1e007b39a')->references('id')->on('templates')->onDelete('cascade');
                
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
        Schema::dropIfExists('layout_template');
    }
}
