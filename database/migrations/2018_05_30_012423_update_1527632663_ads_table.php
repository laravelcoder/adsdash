<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527632663AdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            if(Schema::hasColumn('ads', 'clip_id')) {
                $table->dropForeign('163042_5b0dcdf806d1d');
                $table->dropIndex('163042_5b0dcdf806d1d');
                $table->dropColumn('clip_id');
            }
            if(Schema::hasColumn('ads', 'video_clip')) {
                $table->dropColumn('video_clip');
            }
            if(Schema::hasColumn('ads', 'image')) {
                $table->dropColumn('image');
            }
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
                        $table->string('video_clip')->nullable();
                $table->string('image')->nullable();
                
        });

    }
}
