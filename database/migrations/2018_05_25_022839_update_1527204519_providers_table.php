<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527204519ProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('providers', function (Blueprint $table) {
            if(Schema::hasColumn('providers', 'network_affiliate_id')) {
                $table->dropForeign('163808_5b073a904483f');
                $table->dropIndex('163808_5b073a904483f');
                $table->dropColumn('network_affiliate_id');
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
