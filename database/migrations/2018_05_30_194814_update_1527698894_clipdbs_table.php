<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527698894ClipdbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clipdbs', function (Blueprint $table) {
            if(Schema::hasColumn('clipdbs', 'created_by_id')) {
                $table->dropForeign('164207_5b0861788dff3');
                $table->dropIndex('164207_5b0861788dff3');
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
        Schema::table('clipdbs', function (Blueprint $table) {
                        
        });

    }
}
