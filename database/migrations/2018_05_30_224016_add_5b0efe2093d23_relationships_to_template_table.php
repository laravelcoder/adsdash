<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0efe2093d23RelationshipsToTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('templates', function(Blueprint $table) {
            if (!Schema::hasColumn('templates', 'page_template_id')) {
                $table->integer('page_template_id')->unsigned()->nullable();
                $table->foreign('page_template_id', '165761_5b0efe1c919b7')->references('id')->on('content_pages')->onDelete('cascade');
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
        Schema::table('templates', function(Blueprint $table) {
            
        });
    }
}
