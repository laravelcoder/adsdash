<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0f2f19465f4ContentPageTopScriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('content_page_top_script')) {
            Schema::create('content_page_top_script', function (Blueprint $table) {
                $table->integer('content_page_id')->unsigned()->nullable();
                $table->foreign('content_page_id', 'fk_p_163020_165773_topscr_5b0f2f194678b')->references('id')->on('content_pages')->onDelete('cascade');
                $table->integer('top_script_id')->unsigned()->nullable();
                $table->foreign('top_script_id', 'fk_p_165773_163020_conten_5b0f2f1946898')->references('id')->on('top_scripts')->onDelete('cascade');
                
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
        Schema::dropIfExists('content_page_top_script');
    }
}
