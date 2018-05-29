<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b0de017b0a6aTopScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('top_scripts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('top_scripts')) {
            Schema::create('top_scripts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('script')->nullable();
                $table->tinyInteger('jquery')->nullable()->default('1');
                
                $table->timestamps();
                $table->softDeletes();

            $table->index(['deleted_at']);
            });
        }
    }
}
