<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527631130ClipdbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clipdbs', function (Blueprint $table) {
            if(Schema::hasColumn('clipdbs', 'ad_id')) {
                $table->dropForeign('164207_5b0861787edce');
                $table->dropIndex('164207_5b0861787edce');
                $table->dropColumn('ad_id');
            }
            if(Schema::hasColumn('clipdbs', 'link_to_clip')) {
                $table->dropColumn('link_to_clip');
            }
            if(Schema::hasColumn('clipdbs', 'video_upload')) {
                $table->dropColumn('video_upload');
            }
            if(Schema::hasColumn('clipdbs', 'image_upload')) {
                $table->dropColumn('image_upload');
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
        Schema::table('clipdbs', function (Blueprint $table) {
                        $table->string('link_to_clip')->nullable();
                $table->string('video_upload')->nullable();
                $table->string('image_upload')->nullable();
                
        });

    }
}
