<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('username', 25)->unique('username');
			$table->string('password', 32);
			$table->string('email', 50)->unique('email');
			$table->string('verifyHash', 32);
			$table->date('registOn');
			$table->integer('active')->default(0);
			$table->string('name', 50)->nullable();
			$table->string('bio', 60)->nullable();
			$table->text('img', 65535)->nullable();
			$table->decimal('lati', 10, 8)->nullable();
			$table->decimal('longi', 11, 8)->nullable();
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
		Schema::drop('user');
	}

}
