<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('departments', function($table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->boolean('isAcademic', 255);
			$table->integer('schools_colleges_id')->unsigned()->nullable();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('departments', function($table) 
		{
			$table->foreign('schools_colleges_id')->references('id')->on('schools_colleges');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('departments');
	}

}
