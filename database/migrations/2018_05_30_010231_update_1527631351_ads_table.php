<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527631351AdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            
if (!Schema::hasColumn('ads', 'video_clip')) {
                $table->string('video_clip')->nullable();
                }
if (!Schema::hasColumn('ads', 'image')) {
                $table->string('image')->nullable();
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
            $table->dropColumn('video_clip');
            $table->dropColumn('image');
            
        });

    }
}
