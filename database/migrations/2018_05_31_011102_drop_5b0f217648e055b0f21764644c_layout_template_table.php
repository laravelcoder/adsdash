<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b0f217648e055b0f21764644cLayoutTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('layout_template');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('layout_template')) {
            Schema::create('layout_template', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('layout_id')->unsigned()->nullable();
            $table->foreign('layout_id', 'fk_p_166423_165761_templa_5b0f1dfd371f4')->references('id')->on('layouts');
                $table->integer('template_id')->unsigned()->nullable();
            $table->foreign('template_id', 'fk_p_165761_166423_layout_5b0f1dfd369d1')->references('id')->on('templates');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
