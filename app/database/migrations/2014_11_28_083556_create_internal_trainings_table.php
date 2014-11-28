<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalTrainingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('internal_trainings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('title', 255);
			$table->text('theme_topic', 255);
			$table->text('venue', 255);
			$table->date('date_start');
			$table->date(‘date_end’);
			$table->time('time_start');
			$table->time('time_end');
			$table->text('objectives');
			$table->text('expected_outcome');
			$table->text('evaluation_narrative');
			$table->text('recommendations');

			$table->integer(‘organizer_schools_colleges_id’)->unsigned();
			$table->foreign(‘organizer_schools_colleges_id’)->references(‘id’)->on(‘schools_colleges’);

			$table->integer(‘organizer_department_id’)->unsigned();
			$table->foreign(‘organizer_department_id’)->references(‘id’)->on(‘departments’);

			$table->boolean(‘isActive’)->default(true);
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
		Schema::drop('internal_trainings');
	}

}
