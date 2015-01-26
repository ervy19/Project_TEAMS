<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_attendances', function($table)
		{
			$table->increments('id');
			$table->time('time');

			$table->integer('employee_id')->unsigned();
			$table->integer('internal_training_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('it_attendances', function($table) 
		{
			$table->foreign('employee_id')->references('id')->on('employees');
			$table->foreign('internal_training_id')->references('training_id')->on('internal_trainings');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
