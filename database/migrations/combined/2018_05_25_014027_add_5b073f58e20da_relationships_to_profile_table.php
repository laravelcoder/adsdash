<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b073f58e20daRelationshipsToProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function(Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '163023_5b05fbf8bcc68')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('profiles', function(Blueprint $table) {
            if(Schema::hasColumn('profiles', 'created_by_id')) {
                $table->dropForeign('163023_5b05fbf8bcc68');
                $table->dropIndex('163023_5b05fbf8bcc68');
                $table->dropColumn('created_by_id');
            }
            
        });
    }
}
