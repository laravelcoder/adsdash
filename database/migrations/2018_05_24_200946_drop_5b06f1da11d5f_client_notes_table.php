<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b06f1da11d5fClientNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('client_notes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('client_notes')) {
            Schema::create('client_notes', function (Blueprint $table) {
                $table->increments('id');
                $table->text('text')->nullable();
                
                $table->timestamps();
                
            });
        }
    }
}
