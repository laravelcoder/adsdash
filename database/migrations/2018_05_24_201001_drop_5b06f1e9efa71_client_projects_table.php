<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b06f1e9efa71ClientProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('client_projects');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('client_projects')) {
            Schema::create('client_projects', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->text('description');
                $table->date('date')->nullable();
                $table->string('budget')->nullable();
                
                $table->timestamps();
                
            });
        }
    }
}
