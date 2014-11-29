<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItAttendances extends Migration {

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
			$table->datetime('Time');

<<<<<<< HEAD
			$table->integer(‘employee_id’)->unsigned();
			$table->integer(‘internal_training_id’)->unsigned();
			
			$table->boolean(‘isActive’)->default(true);
=======
			$table->integer('employee_id')->unsigned();
			$table->foreign('employee_id')->references('id')->on('employees');

			$table->integer('internal_training_id')->unsigned();
			$table->foreign('internal_training_id')->references('id')->on('internal_trainings');

			$table->boolean('isActive')->default(true);
>>>>>>> origin/master
			$table->timestamps();
		});

		Schema::table('it_attendances', function($table) 
		{
      		$table->foreign(‘employee_id’)->references(‘id’)->on(‘employees’);
      		$table->foreign(‘internal_training_id’)->references(‘id’)->on(‘internal_trainings’);
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('it_attendances');
	}

}
