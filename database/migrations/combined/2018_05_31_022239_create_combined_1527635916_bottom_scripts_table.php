<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1527635916BottomScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('bottom_scripts')) {
            Schema::create('bottom_scripts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('script')->nullable();
                $table->string('name')->nullable();
                $table->tinyInteger('jquery')->nullable()->default('0');
                
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
        Schema::dropIfExists('bottom_scripts');
    }
}
