<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527276203AdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            if(Schema::hasColumn('ads', 'link')) {
                $table->dropColumn('link');
            }
            
        });
Schema::table('ads', function (Blueprint $table) {
            
if (!Schema::hasColumn('ads', 'ad_description')) {
                $table->text('ad_description')->nullable();
                }
if (!Schema::hasColumn('ads', 'total_impressions')) {
                $table->integer('total_impressions')->nullable();
                }
if (!Schema::hasColumn('ads', 'total_networks')) {
                $table->integer('total_networks')->nullable();
                }
if (!Schema::hasColumn('ads', 'total_channels')) {
                $table->integer('total_channels')->nullable();
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
            $table->dropColumn('ad_description');
            $table->dropColumn('total_impressions');
            $table->dropColumn('total_networks');
            $table->dropColumn('total_channels');
            
        });
Schema::table('ads', function (Blueprint $table) {
                        $table->string('link')->nullable();
                
        });

    }
}
