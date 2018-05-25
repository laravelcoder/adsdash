<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1527275892ClipdbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('clipdbs')) {
            Schema::create('clipdbs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('clip_label')->nullable();
                $table->string('link_to_clip')->nullable();
                $table->string('video_upload')->nullable();
                $table->string('image_upload')->nullable();
                
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
        Schema::dropIfExists('clipdbs');
    }
}
