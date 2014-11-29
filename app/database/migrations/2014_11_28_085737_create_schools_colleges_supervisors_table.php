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
		Schema::create('schools_colleges_supervisors', function($table)
		{
			$table->increments('id');
			$table->text('name', 100);

			$table->integer('schools_colleges_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('schools_colleges_supervisors', function($table) 
		{
			$table->foreign('schools_colleges_id')->references('id')-on('schools_colleges');
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
