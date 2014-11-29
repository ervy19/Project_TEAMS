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
			$table->text('title', 255)->nullable();
			$table->text('theme_topic', 255);
			$table->text('venue', 255)->nullable();
			$table->date('date_start')->nullable();
			$table->date('date_end')->nullable();
			$table->time('time_start')->nullable();
			$table->time('time_end')->nullable();
			$table->text('objectives');
			$table->text('expected_outcome')->nullable();
			$table->text('evaluation_narrative')->nullable();
			$table->text('recommendations')->nullable();

			$table->integer('organizer_schools_colleges_id')->unsigned();

			$table->integer('organizer_department_id')->unsigned();
			$table->foreign('organizer_department_id')->references('id')->on('departments');

			$table->boolean('isTrainingPlan')->default(false);
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
		Schema::drop('internal_trainings');
	}

}
