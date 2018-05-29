<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b06f2fc702b7AssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('assets');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
}
