<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b07448748a7cAudienceContactCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('audience_contact_company')) {
            Schema::create('audience_contact_company', function (Blueprint $table) {
                $table->integer('audience_id')->unsigned()->nullable();
                $table->foreign('audience_id', 'fk_p_163045_163014_contac_5b07448748b82')->references('id')->on('audiences')->onDelete('cascade');
                $table->integer('contact_company_id')->unsigned()->nullable();
                $table->foreign('contact_company_id', 'fk_p_163014_163045_audien_5b07448748c27')->references('id')->on('contact_companies')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audience_contact_company');
    }
}
