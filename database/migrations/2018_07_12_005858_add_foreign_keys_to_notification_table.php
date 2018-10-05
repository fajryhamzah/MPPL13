<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('notification', function(Blueprint $table)
		{
			$table->foreign('id_post', 'notification_ibfk_2')->references('id')->on('open_adoption')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_target', 'notification_ibfk_3')->references('id')->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('notification', function(Blueprint $table)
		{
			$table->dropForeign('notification_ibfk_2');
			$table->dropForeign('notification_ibfk_3');
		});
	}

}
