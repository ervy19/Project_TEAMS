<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trainings', function($table)
		{
			$table->increments('id');
			$table->string('title', 255)->nullable();
			$table->string('theme_topic', 255);
			$table->string('venue', 255)->nullable();
			$table->string('schedule', 255);

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
		Schema::drop('trainings');
	}

}
