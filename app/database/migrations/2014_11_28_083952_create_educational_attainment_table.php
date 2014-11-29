<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalAttainmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('educational_attainment', function($table)
		{
			$table->increments('id');
			$table->text('degree_title', 100);
			$table->text('degree_course', 255);
			$table->text('institution', 255);
			$table->text('year_attained', 4);
			
			$table->integer('employee_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('educational_attainment', function($table) 
		{
			$table->foreign('employee_id')->references('id')->on('employees');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('educational_attainment');
	}

}
