<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527720841BottomScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bottom_scripts', function (Blueprint $table) {
            if(Schema::hasColumn('bottom_scripts', 'template_id')) {
                $table->dropForeign('165765_5b0ddfd083e67');
                $table->dropIndex('165765_5b0ddfd083e67');
                $table->dropColumn('template_id');
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
