<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527721516StylesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stylesheets', function (Blueprint $table) {
            if(Schema::hasColumn('stylesheets', 'template_id')) {
                $table->dropForeign('165762_5b0ddc04c682c');
                $table->dropIndex('165762_5b0ddc04c682c');
                $table->dropColumn('template_id');
            }
            
        });
Schema::table('stylesheets', function (Blueprint $table) {
            
if (!Schema::hasColumn('stylesheets', 'order')) {
                $table->integer('order')->nullable()->unsigned();
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
            $table->dropColumn('order');
            
        });
Schema::table('stylesheets', function (Blueprint $table) {
                        
        });

    }
}
