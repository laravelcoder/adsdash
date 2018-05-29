<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527634948StylesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stylesheets', function (Blueprint $table) {
            if(Schema::hasColumn('stylesheets', 'created_by_id')) {
                $table->dropForeign('165762_5b0dd999d177a');
                $table->dropIndex('165762_5b0dd999d177a');
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
        Schema::table('stylesheets', function (Blueprint $table) {
                        
        });

    }
}
