<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0de14082633RelationshipsToContentPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_pages', function(Blueprint $table) {
            if (!Schema::hasColumn('content_pages', 'template_id')) {
                $table->integer('template_id')->unsigned()->nullable();
                $table->foreign('template_id', '163020_5b0dd66f19748')->references('id')->on('templates')->onDelete('cascade');
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
        Schema::table('content_pages', function(Blueprint $table) {
            if(Schema::hasColumn('content_pages', 'template_id')) {
                $table->dropForeign('163020_5b0dd66f19748');
                $table->dropIndex('163020_5b0dd66f19748');
                $table->dropColumn('template_id');
            }
            
        });
    }
}
