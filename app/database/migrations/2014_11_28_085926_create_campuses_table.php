<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campuses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('title', 100);
			$table->text('address', 255);

			$table->boolean(‘isActive’)->default(true);
			$table->timestamps;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campuses');
	}

}
