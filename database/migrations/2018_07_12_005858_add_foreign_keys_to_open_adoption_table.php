<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOpenAdoptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('open_adoption', function(Blueprint $table)
		{
			$table->foreign('poster_id', 'open_adoption_ibfk_1')->references('id')->on('user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('category_pet', 'open_adoption_ibfk_2')->references('id')->on('category_pet')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('open_adoption', function(Blueprint $table)
		{
			$table->dropForeign('open_adoption_ibfk_1');
			$table->dropForeign('open_adoption_ibfk_2');
		});
	}

}
