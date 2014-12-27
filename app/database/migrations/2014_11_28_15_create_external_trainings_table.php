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
			$table->integer('training_id')->unsigned();
			$table->string('participation', 255);
			$table->string('organizer', 255);

			$table->integer('designation_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('external_trainings', function($table) 
		{
			$table->foreign('training_id')->references('id')->on('trainings');
			$table->foreign('designation_id')->references('id')->on('employee_designations');
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
