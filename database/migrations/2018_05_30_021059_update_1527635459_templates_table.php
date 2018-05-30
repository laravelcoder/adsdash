<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527635459TemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('templates', function (Blueprint $table) {
            if(Schema::hasColumn('templates', 'created_by_id')) {
                $table->dropForeign('165761_5b0dd5aad0bfc');
                $table->dropIndex('165761_5b0dd5aad0bfc');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('templates', 'created_by_team_id')) {
                $table->dropForeign('165761_5b0dd5aadf46b');
                $table->dropIndex('165761_5b0dd5aadf46b');
                $table->dropColumn('created_by_team_id');
            }
            
        });
Schema::table('templates', function (Blueprint $table) {
            
if (!Schema::hasColumn('templates', 'description')) {
                $table->string('description')->nullable();
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
        Schema::table('templates', function (Blueprint $table) {
            $table->dropColumn('description');
            
        });
Schema::table('templates', function (Blueprint $table) {
                        
        });

    }
}
