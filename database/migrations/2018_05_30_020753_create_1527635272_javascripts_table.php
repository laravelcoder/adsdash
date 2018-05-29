<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1527635272JavascriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('javascripts');
    }
}
