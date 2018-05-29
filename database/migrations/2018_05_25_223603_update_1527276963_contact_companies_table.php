<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527276963ContactCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_companies', function (Blueprint $table) {
            
if (!Schema::hasColumn('contact_companies', 'city')) {
                $table->string('city')->nullable();
                }
if (!Schema::hasColumn('contact_companies', 'state')) {
                $table->string('state')->nullable();
                }
if (!Schema::hasColumn('contact_companies', 'zipcode')) {
                $table->string('zipcode')->nullable();
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
        Schema::table('contact_companies', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('zipcode');
            
        });

    }
}
