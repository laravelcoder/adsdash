<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b0de0599b344JavascriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('javascripts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('javascripts')) {
            Schema::create('javascripts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('top_script')->nullable();
                $table->string('bottom_script')->nullable();
                $table->string('name')->nullable();
                $table->string('add_to_array')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

            $table->index(['deleted_at']);
            });
        }
    }
}
