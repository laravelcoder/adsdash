<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b06f234e6b14ClientIncomeSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('client_income_sources');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('client_income_sources')) {
            Schema::create('client_income_sources', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->double('fee_percent', 15, 2)->nullable();
                
                $table->timestamps();
                
            });
        }
    }
}
