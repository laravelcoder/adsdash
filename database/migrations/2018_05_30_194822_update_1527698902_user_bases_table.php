<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527698902UserBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_bases', function (Blueprint $table) {
            if(Schema::hasColumn('user_bases', 'created_by_id')) {
                $table->dropForeign('163055_5b0609a33dc0a');
                $table->dropIndex('163055_5b0609a33dc0a');
                $table->dropColumn('created_by_id');
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
        Schema::table('user_bases', function (Blueprint $table) {
                        
        });

    }
}
