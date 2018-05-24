<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b060671d477eRelationshipsToClientTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_transactions', function(Blueprint $table) {
            if (!Schema::hasColumn('client_transactions', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '163035_5b05fff3735c0')->references('id')->on('client_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_transactions', 'transaction_type_id')) {
                $table->integer('transaction_type_id')->unsigned()->nullable();
                $table->foreign('transaction_type_id', '163035_5b05fff383677')->references('id')->on('client_transaction_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_transactions', 'income_source_id')) {
                $table->integer('income_source_id')->unsigned()->nullable();
                $table->foreign('income_source_id', '163035_5b05fff392e72')->references('id')->on('client_income_sources')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_transactions', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '163035_5b05fff3a2b4f')->references('id')->on('client_currencies')->onDelete('cascade');
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
        Schema::table('client_transactions', function(Blueprint $table) {
            if(Schema::hasColumn('client_transactions', 'project_id')) {
                $table->dropForeign('163035_5b05fff3735c0');
                $table->dropIndex('163035_5b05fff3735c0');
                $table->dropColumn('project_id');
            }
            if(Schema::hasColumn('client_transactions', 'transaction_type_id')) {
                $table->dropForeign('163035_5b05fff383677');
                $table->dropIndex('163035_5b05fff383677');
                $table->dropColumn('transaction_type_id');
            }
            if(Schema::hasColumn('client_transactions', 'income_source_id')) {
                $table->dropForeign('163035_5b05fff392e72');
                $table->dropIndex('163035_5b05fff392e72');
                $table->dropColumn('income_source_id');
            }
            if(Schema::hasColumn('client_transactions', 'currency_id')) {
                $table->dropForeign('163035_5b05fff3a2b4f');
                $table->dropIndex('163035_5b05fff3a2b4f');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
