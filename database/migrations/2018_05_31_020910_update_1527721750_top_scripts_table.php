<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527721750TopScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_scripts', function (Blueprint $table) {
            if(Schema::hasColumn('top_scripts', 'template_id')) {
                $table->dropForeign('165773_5b0de13b2dd3e');
                $table->dropIndex('165773_5b0de13b2dd3e');
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
        Schema::table('top_scripts', function (Blueprint $table) {
                        
        });

    }
}
