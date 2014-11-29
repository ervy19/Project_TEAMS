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
		Schema::create('speaker_evaluations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('evaluation_criterion1', 1, 4);
			$table->decimal('evaluation_criterion2', 1, 4);
			$table->decimal('evaluation_criterion3', 1, 4);
			
			$table->integer('training_id')->unsigned();
			$table->foreign('training_id')->references('id')->on('internal_trainings');
			
			$table->integer('speaker_id')->unsigned();
			$table->foreign('speaker_id')->references('id')->on('speakers');

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
		Schema::drop('speaker_evaluations');
	}

}
