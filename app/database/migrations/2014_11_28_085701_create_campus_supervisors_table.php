<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusSupervisorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('”campus_supervisors”', function(Blueprint $table)
		{
			$table->increments(‘id’);
			$table->text(‘name’, 100);

			$table->integer(‘campus_id’)->unsigned();
			$table->foreign(‘campus_id’)->references(‘id’)->on(‘campuses’);

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
		Schema::drop('”campus_supervisors”');
	}

}
