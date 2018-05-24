<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b06f1b82cdceClientTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('client_transactions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('client_transactions')) {
            Schema::create('client_transactions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->decimal('amount', 15, 2)->nullable();
                $table->date('transaction_date')->nullable();
                
                $table->timestamps();
                
            });
        }
    }
}
