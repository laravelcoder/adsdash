<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b086fad0a46eRelationshipsToPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones', function(Blueprint $table) {
            if (!Schema::hasColumn('phones', 'contact_id')) {
                $table->integer('contact_id')->unsigned()->nullable();
                $table->foreign('contact_id', '164213_5b086deba6b3d')->references('id')->on('contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('phones', 'agent_id')) {
                $table->integer('agent_id')->unsigned()->nullable();
                $table->foreign('agent_id', '164213_5b086debb2daf')->references('id')->on('agents')->onDelete('cascade');
                }
                if (!Schema::hasColumn('phones', 'company_id')) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', '164213_5b086debbd1be')->references('id')->on('contact_companies')->onDelete('cascade');
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
