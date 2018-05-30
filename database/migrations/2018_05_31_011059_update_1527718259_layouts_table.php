<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527718259LayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            if(Schema::hasColumn('layouts', 'page_id')) {
                $table->dropForeign('166423_5b0f1dfd46b26');
                $table->dropIndex('166423_5b0f1dfd46b26');
                $table->dropColumn('page_id');
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
        Schema::table('layouts', function (Blueprint $table) {
                        
        });

    }
}
