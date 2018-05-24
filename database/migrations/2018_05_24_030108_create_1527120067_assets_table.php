<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1527120067AssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('assets')) {
            Schema::create('assets', function (Blueprint $table) {
                $table->increments('id');
                $table->string('serial_number')->nullable();
                $table->string('title')->nullable();
                $table->string('photo1')->nullable();
                $table->string('photo2')->nullable();
                $table->string('photo3')->nullable();
                $table->text('notes')->nullable();
                
                $table->timestamps();
                
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
        Schema::dropIfExists('assets');
    }
}
