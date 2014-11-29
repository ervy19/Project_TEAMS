<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakerEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('speaker_evaluations', function($table)
		{
			$table->increments('id');
			$table->decimal('evaluation_criterion1', 1, 4);
			$table->decimal('evaluation_criterion2', 1, 4);
			$table->decimal('evaluation_criterion3', 1, 4);
			
			$table->integer('training_id')->unsigned();
			$table->integer('speaker_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('speaker_evaluations', function($table) 
		{
			$table->foreign('training_id')->references('id')->on('internal_trainings');
			$table->foreign('speaker_id')->references('id')->on('speakers');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('speaker_evaluations');
	}

}
