<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoryPetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_pet', function(Blueprint $table)
		{
			$table->foreign('parent_id', 'category_pet_ibfk_1')->references('id')->on('category_pet')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('category_pet', function(Blueprint $table)
		{
			$table->dropForeign('category_pet_ibfk_1');
		});
	}

}
