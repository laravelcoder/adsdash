<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527277294ContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            if(Schema::hasColumn('contacts', 'created_by_id')) {
                $table->dropForeign('fk_163015_user_created_by_id_contact');
                $table->dropIndex('fk_163015_user_created_by_id_contact');
                $table->dropColumn('created_by_id');
            }
            
        });
Schema::table('contacts', function (Blueprint $table) {
            
if (!Schema::hasColumn('contacts', 'photo')) {
                $table->string('photo')->nullable();
                }
if (!Schema::hasColumn('contacts', 'about')) {
                $table->text('about')->nullable();
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('about');
            
        });
Schema::table('contacts', function (Blueprint $table) {
                        
        });

    }
}
