<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527635729TopScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_scripts', function (Blueprint $table) {
            if(Schema::hasColumn('top_scripts', 'top_script')) {
                $table->dropColumn('top_script');
            }
            
        });
Schema::table('top_scripts', function (Blueprint $table) {
            
if (!Schema::hasColumn('top_scripts', 'script')) {
                $table->string('script')->nullable();
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
            $table->dropColumn('script');
            
        });
Schema::table('top_scripts', function (Blueprint $table) {
                        $table->string('top_script')->nullable();
                
        });

    }
}
