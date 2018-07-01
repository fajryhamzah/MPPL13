<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasTable('notification')) { return; }
		Schema::create('notification', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_target')->index('id_target');
			$table->integer('id_post')->nullable()->index('id_post');
			$table->enum('type', array('new_bidder','chosen','other'));
			$table->dateTime('date');
			$table->boolean('seen')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notification');
	}

}
