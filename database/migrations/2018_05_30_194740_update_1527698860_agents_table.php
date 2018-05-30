<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527698860AgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            if(Schema::hasColumn('agents', 'created_by_id')) {
                $table->dropForeign('164212_5b08676ce1827');
                $table->dropIndex('164212_5b08676ce1827');
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
        Schema::table('agents', function (Blueprint $table) {
                        
        });

    }
}
