<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0f3240d58c1BottomScriptContentPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('bottom_script_content_page')) {
            Schema::create('bottom_script_content_page', function (Blueprint $table) {
                $table->integer('bottom_script_id')->unsigned()->nullable();
                $table->foreign('bottom_script_id', 'fk_p_165765_163020_conten_5b0f3240d59c1')->references('id')->on('bottom_scripts')->onDelete('cascade');
                $table->integer('content_page_id')->unsigned()->nullable();
                $table->foreign('content_page_id', 'fk_p_163020_165765_bottom_5b0f3240d5a8d')->references('id')->on('content_pages')->onDelete('cascade');
                
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
        Schema::dropIfExists('bottom_script_content_page');
    }
}
