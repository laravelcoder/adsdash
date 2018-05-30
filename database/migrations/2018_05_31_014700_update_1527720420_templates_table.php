<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527720420TemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('templates', function (Blueprint $table) {
            if(Schema::hasColumn('templates', 'content')) {
                $table->dropColumn('content');
            }
            if(Schema::hasColumn('templates', 'description')) {
                $table->dropColumn('description');
            }
            
        });
Schema::table('templates', function (Blueprint $table) {
            
if (!Schema::hasColumn('templates', 'content')) {
                $table->text('content')->nullable();
                }
if (!Schema::hasColumn('templates', 'description')) {
                $table->text('description')->nullable();
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
            $table->dropColumn('description');
            
        });
Schema::table('templates', function (Blueprint $table) {
                        $table->string('content')->nullable();
                $table->string('description')->nullable();
                
        });

    }
}
