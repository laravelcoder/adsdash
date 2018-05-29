<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527279529PhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function (Blueprint $table) {
            if(Schema::hasColumn('phones', 'type')) {
                $table->dropColumn('type');
            }
            
        });
Schema::table('phones', function (Blueprint $table) {
            
if (!Schema::hasColumn('phones', 'phone_type')) {
                $table->string('phone_type')->nullable();
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
        Schema::table('phones', function (Blueprint $table) {
            $table->dropColumn('phone_type');
            
        });
Schema::table('phones', function (Blueprint $table) {
                        $table->enum('type', array('Personal', 'Mobile', 'Office', 'Toll Free', 'Other'));
                
        });

    }
}
