<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0743c35eaf0PermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('permission_role')) {
            Schema::create('permission_role', function (Blueprint $table) {
                $table->integer('permission_id')->unsigned()->nullable();
                $table->foreign('permission_id', 'fk_p_163010_163011_role_p_5b0743c35ebf7')->references('id')->on('permissions')->onDelete('cascade');
                $table->integer('role_id')->unsigned()->nullable();
                $table->foreign('role_id', 'fk_p_163011_163010_permis_5b0743c35ec9d')->references('id')->on('roles')->onDelete('cascade');
                
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
        Schema::dropIfExists('permission_role');
    }
}
