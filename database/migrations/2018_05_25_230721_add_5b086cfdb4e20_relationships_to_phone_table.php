<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b086cfdb4e20RelationshipsToPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function(Blueprint $table) {
            if (!Schema::hasColumn('phones', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '164213_5b086cfa8ef38')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('phones', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '164213_5b086cfa9db3a')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('phones', function(Blueprint $table) {
            
        });
    }
}
