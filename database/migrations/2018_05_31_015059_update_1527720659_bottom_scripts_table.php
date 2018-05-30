<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527720659BottomScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bottom_scripts', function (Blueprint $table) {
            if(Schema::hasColumn('bottom_scripts', 'created_by_id')) {
                $table->dropForeign('165765_5b0ddfd096129');
                $table->dropIndex('165765_5b0ddfd096129');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('bottom_scripts', 'created_by_team_id')) {
                $table->dropForeign('165765_5b0ddfd0a62c5');
                $table->dropIndex('165765_5b0ddfd0a62c5');
                $table->dropColumn('created_by_team_id');
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
        Schema::table('bottom_scripts', function (Blueprint $table) {
                        
        });

    }
}
