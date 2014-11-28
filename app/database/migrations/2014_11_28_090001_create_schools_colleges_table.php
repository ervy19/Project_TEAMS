<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsCollegesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('”schools_colleges”', function(Blueprint $table)
		{
			$table->increments(‘id’);
			$table->text(‘name’, 100);

			$table->boolean(‘isActive’)->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('”schools_colleges”');
	}

}
