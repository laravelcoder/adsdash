<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1527119846ClientDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('client_documents')) {
            Schema::create('client_documents', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('file')->nullable();
                
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
        Schema::dropIfExists('client_documents');
    }
}
