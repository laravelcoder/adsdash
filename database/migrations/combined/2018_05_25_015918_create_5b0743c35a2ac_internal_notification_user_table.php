<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0743c35a2acInternalNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('internal_notification_user')) {
            Schema::create('internal_notification_user', function (Blueprint $table) {
                $table->integer('internal_notification_id')->unsigned()->nullable();
                $table->foreign('internal_notification_id', 'fk_p_163016_163012_user_i_5b0743c35a3a7')->references('id')->on('internal_notifications')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_p_163012_163016_intern_5b0743c35a470')->references('id')->on('users')->onDelete('cascade');
                $table->timestamp("read_at")->nullable();
		$table->timestamp("created_at")->default(DB::raw("CURRENT_TIMESTAMP"));
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
        Schema::dropIfExists('internal_notification_user');
    }
}
