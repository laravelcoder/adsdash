<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0609fe32532RelationshipsToAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets', function(Blueprint $table) {
            if (!Schema::hasColumn('assets', 'category_id')) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', '163040_5b0600c6d3486')->references('id')->on('assets_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('assets', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '163040_5b0600c6e61fb')->references('id')->on('assets_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('assets', 'location_id')) {
                $table->integer('location_id')->unsigned()->nullable();
                $table->foreign('location_id', '163040_5b0600c705565')->references('id')->on('assets_locations')->onDelete('cascade');
                }
                if (!Schema::hasColumn('assets', 'assigned_user_id')) {
                $table->integer('assigned_user_id')->unsigned()->nullable();
                $table->foreign('assigned_user_id', '163040_5b0600c7193a4')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('assets', function(Blueprint $table) {
            if(Schema::hasColumn('assets', 'category_id')) {
                $table->dropForeign('163040_5b0600c6d3486');
                $table->dropIndex('163040_5b0600c6d3486');
                $table->dropColumn('category_id');
            }
            if(Schema::hasColumn('assets', 'status_id')) {
                $table->dropForeign('163040_5b0600c6e61fb');
                $table->dropIndex('163040_5b0600c6e61fb');
                $table->dropColumn('status_id');
            }
            if(Schema::hasColumn('assets', 'location_id')) {
                $table->dropForeign('163040_5b0600c705565');
                $table->dropIndex('163040_5b0600c705565');
                $table->dropColumn('location_id');
            }
            if(Schema::hasColumn('assets', 'assigned_user_id')) {
                $table->dropForeign('163040_5b0600c7193a4');
                $table->dropIndex('163040_5b0600c7193a4');
                $table->dropColumn('assigned_user_id');
            }
            
        });
    }
}
