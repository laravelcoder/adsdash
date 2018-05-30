<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527717905TemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('templates', function (Blueprint $table) {
            if(Schema::hasColumn('templates', 'layout')) {
                $table->dropColumn('layout');
            }
            if(Schema::hasColumn('templates', 'template_link')) {
                $table->dropColumn('template_link');
            }
            if(Schema::hasColumn('templates', 'page_template_id')) {
                $table->dropForeign('165761_5b0efe1c919b7');
                $table->dropIndex('165761_5b0efe1c919b7');
                $table->dropColumn('page_template_id');
            }
            
        });
Schema::table('templates', function (Blueprint $table) {
            
if (!Schema::hasColumn('templates', 'content')) {
                $table->string('content')->nullable();
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
        Schema::table('templates', function (Blueprint $table) {
            $table->dropColumn('content');
            
        });
Schema::table('templates', function (Blueprint $table) {
                        $table->text('layout')->nullable();
                $table->string('template_link')->nullable();
                
        });

    }
}
