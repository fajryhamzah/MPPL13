<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAdoptingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('adopting', function(Blueprint $table)
		{
			$table->foreign('post_id', 'adopting_ibfk_1')->references('id')->on('open_adoption')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('bidder_id', 'adopting_ibfk_2')->references('id')->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('adopting', function(Blueprint $table)
		{
			$table->dropForeign('adopting_ibfk_1');
			$table->dropForeign('adopting_ibfk_2');
		});
	}

}
