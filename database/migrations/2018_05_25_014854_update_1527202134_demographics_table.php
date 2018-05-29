<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527202134DemographicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demographics', function (Blueprint $table) {
            if(Schema::hasColumn('demographics', 'created_by_id')) {
                $table->dropForeign('163046_5b06081fd36bb');
                $table->dropIndex('163046_5b06081fd36bb');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('demographics', 'created_by_team_id')) {
                $table->dropForeign('163046_5b06081fe34c8');
                $table->dropIndex('163046_5b06081fe34c8');
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
        Schema::table('demographics', function (Blueprint $table) {
                        
        });

    }
}
