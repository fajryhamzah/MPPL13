<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpenAdoptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('open_adoption', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 50);
			$table->boolean('gender');
			$table->integer('age');
			$table->text('description', 65535);
			$table->integer('poster_id')->index('poster_id');
			$table->date('post_date');
			$table->integer('category_pet')->index('category_pet');
			$table->decimal('lati', 10, 8);
			$table->decimal('longi', 11, 8);
			$table->integer('status');
			$table->date('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('open_adoption');
	}

}
