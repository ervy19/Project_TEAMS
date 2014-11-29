<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsCollegesSupervisorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('”schools_colleges_supervisors”', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name', 100);

			$table->integer('schools_colleges_id')->unsigned();
			$table->foreign('schools_colleges_id')->references('id')-on('schools_colleges');

			$table->boolean('isActive')->default(true);
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
		Schema::drop('schools_colleges_supervisors');
	}

}
