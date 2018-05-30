<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527698870AdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            if(Schema::hasColumn('ads', 'created_by_id')) {
                $table->dropForeign('163042_5b06039011f83');
                $table->dropIndex('163042_5b06039011f83');
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
        Schema::table('ads', function (Blueprint $table) {
                        
        });

    }
}
