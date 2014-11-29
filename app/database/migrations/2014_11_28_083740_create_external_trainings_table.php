<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalTrainingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('external_trainings', function($table)
		{
			$table->increments('id');
			$table->text('title', 255);
			$table->text('theme_topic', 255);
			$table->text('participation', 255);
			$table->text('organizer', 255);
			$table->text('venue', 255);
			$table->date('date_start');
			$table->date('date_end');

<<<<<<< HEAD
			$table->integer(‘designation_id’)->unsigned();
			
			$table->boolean(‘isActive’)->default(true);
=======
			$table->integer('designation_id')->unsigned();
			$table->foreign('designation_id')->references('id')->on('employee_designations');

			$table->boolean('isActive')->default(true);
>>>>>>> origin/master
			$table->timestamps();
		});

		Schema::table('external_trainings', function($table) 
		{
			$table->foreign('designation_id')->references('id')on->on('employee_designations');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('external_trainings');
	}

}
