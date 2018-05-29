<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1527635621TopScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('top_scripts')) {
            Schema::create('top_scripts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('top_script')->nullable();
                $table->string('name')->nullable();
                $table->tinyInteger('jquery')->nullable()->default('1');
                
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
        Schema::dropIfExists('top_scripts');
    }
}
