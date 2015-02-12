<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('training_schedules', function(Blueprint $table)
		{
			$table->increments('id');

			$table->date('date_scheduled');
			$table->string('timeslot', 255);

			$table->boolean('isStartDate')->default(false);
			$table->boolean('isEndDate')->default(false);

			$table->integer('training_id')->unsigned()->nullable();
			$table->integer('et_id')->unsigned()->nullable();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('training_schedules', function($table) 
		{
			$table->foreign('training_id')->references('id')->on('trainings');
			$table->foreign('et_id')->references('id')->on('et_queues');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('training_schedules');
	}

}
