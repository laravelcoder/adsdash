<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0f3240d3350ContentPageStylesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('content_page_stylesheet')) {
            Schema::create('content_page_stylesheet', function (Blueprint $table) {
                $table->integer('content_page_id')->unsigned()->nullable();
                $table->foreign('content_page_id', 'fk_p_163020_165762_styles_5b0f3240d3448')->references('id')->on('content_pages')->onDelete('cascade');
                $table->integer('stylesheet_id')->unsigned()->nullable();
                $table->foreign('stylesheet_id', 'fk_p_165762_163020_conten_5b0f3240d34d5')->references('id')->on('stylesheets')->onDelete('cascade');
                
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
        Schema::dropIfExists('content_page_stylesheet');
    }
}
