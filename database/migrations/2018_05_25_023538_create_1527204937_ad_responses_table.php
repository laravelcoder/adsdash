<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1527204937AdResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('ad_responses')) {
            Schema::create('ad_responses', function (Blueprint $table) {
                $table->increments('id');
                $table->time('time')->nullable();
                $table->integer('impressions')->nullable();
                $table->integer('non_impressions')->nullable();
                $table->string('cypi_id')->nullable();
                
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
        Schema::dropIfExists('ad_responses');
    }
}
