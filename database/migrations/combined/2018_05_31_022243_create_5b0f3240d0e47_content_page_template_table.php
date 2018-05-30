<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0f3240d0e47ContentPageTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('content_page_template')) {
            Schema::create('content_page_template', function (Blueprint $table) {
                $table->integer('content_page_id')->unsigned()->nullable();
                $table->foreign('content_page_id', 'fk_p_163020_165761_templa_5b0f3240d0f49')->references('id')->on('content_pages')->onDelete('cascade');
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', 'fk_p_165761_163020_conten_5b0f3240d0fd9')->references('id')->on('templates')->onDelete('cascade');
                
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
        Schema::dropIfExists('content_page_template');
    }
}