<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDesignationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_designations', function($table)
		{
			$table->increments('id');
			$table->text('type', 50);
			
			$table->integer('employee_id')->unsigned();
			$table->integer('position_id')->unsigned();
			$table->integer('rank_id')->unsigned();
			$table->integer('schools_colleges_id')->unsigned();
			$table->integer('department_id')->unsigned();
			$table->integer('campus_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('employee_designations', function($table) 
		{
			$table->foreign('employee_id')->references('id')->on('employees');
			$table->foreign('position_id')->references('id')->on('positions');
			$table->foreign('rank_id')->references('id')->on('ranks');
			$table->foreign('schools_colleges_id')->references('id')-on('schools_colleges');
			$table->foreign('department_id')->references('id')->on('departments');
			$table->foreign('campus_id')->references('id')->on('campuses');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_designations');
	}

}
