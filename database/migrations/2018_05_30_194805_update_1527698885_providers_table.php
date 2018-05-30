<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527698885ProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('providers', function (Blueprint $table) {
            if(Schema::hasColumn('providers', 'created_by_id')) {
                $table->dropForeign('163808_5b07384f67dd8');
                $table->dropIndex('163808_5b07384f67dd8');
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
        Schema::table('providers', function (Blueprint $table) {
                        
        });

    }
}
