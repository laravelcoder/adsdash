<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1527278839PhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('phones')) {
            Schema::create('phones', function (Blueprint $table) {
                $table->increments('id');
                $table->enum('type', array('Personal', 'Mobile', 'Office', 'Toll Free', 'Other'));
                $table->string('phone_number');
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
