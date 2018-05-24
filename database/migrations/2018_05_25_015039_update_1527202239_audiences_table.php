<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527202239AudiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audiences', function (Blueprint $table) {
            if(Schema::hasColumn('audiences', 'created_by_id')) {
                $table->dropForeign('163045_5b0607c14db6f');
                $table->dropIndex('163045_5b0607c14db6f');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('audiences', 'created_by_team_id')) {
                $table->dropForeign('163045_5b0607c15d896');
                $table->dropIndex('163045_5b0607c15d896');
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
        Schema::table('audiences', function (Blueprint $table) {
                        
        });

    }
}
