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
		Schema::create('participant_assessments', function($table)
		{
			$table->increments('id');
			$table->string('type', 20);
			$table->decimal('rating', 4, 1)->nullable();
			$table->text('verbal_interpretation')->nullable();
			$table->text('remarks')->nullable();
			
			$table->integer('employee_id')->unsigned();
			$table->integer('supervisor_id')->unsigned();
			$table->integer('training_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('participant_assessments', function($table) 
		{
      		$table->foreign('employee_id')->references('id')->on('employees');
      		$table->foreign('supervisor_id')->references('id')->on('supervisors');
      		$table->foreign('training_id')->references('id')->on('internal_trainings');
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
