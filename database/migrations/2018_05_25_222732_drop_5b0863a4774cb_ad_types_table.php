<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b0863a4774cbAdTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ad_types');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('ad_types')) {
            Schema::create('ad_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('codec')->nullable();
                $table->string('extention')->nullable();
                
                $table->timestamps();
                
            });
        }
    }
}
