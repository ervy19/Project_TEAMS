<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantAssessmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('participant_assessments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('type', 5);
			$table->decimal('rating', 1, 4);
			$table->text('verbal_interpretation', 255);
			
			$table->integer('employee_id')->unsigned();
			$table->foreign('employee_id')->references('id')->on('employees');
			
			$table->integer('supervisor_id')->unsigned();
			$table->foreign('supervisor_id')->references('id')->on('supervisors');
			
			$table->integer('training_id')->unsigned();
			$table->foreign('training_id')->references('id')->on('internal_trainings');

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
		Schema::drop('participant_assessments');
	}

}
