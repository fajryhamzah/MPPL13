<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGalleryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gallery', function(Blueprint $table)
		{
			$table->foreign('open_adoption_id', 'gallery_ibfk_1')->references('id')->on('open_adoption')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gallery', function(Blueprint $table)
		{
			$table->dropForeign('gallery_ibfk_1');
		});
	}

}
