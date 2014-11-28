<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_evaluations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('planning_criterion1', 1, 4);
			$table->decimal('planning_criterion2', 1, 4);
			$table->decimal('objectives_criterion1', 1, 4);
			$table->decimal('objectives_criterion2', 1, 4);
			$table->decimal('objectives_criterion3', 1, 4);
			$table->decimal('content_criterion1', 1, 4);
			$table->decimal('content_criterion2', 1, 4);
			$table->decimal('materials_criterion1', 1, 4);
			$table->decimal('materials_criterion2', 1, 4);
			$table->decimal('schedule_criterion1', 1, 4);
			$table->decimal('schedule_criterion2', 1 ,4);
			$table->decimal('schedule_criterion3', 1, 4);
			$table->decimal('openForum_criterion1', 1, 4);
			$table->decimal('openForum_criterion2', 1, 4);
			$table->decimal('openForum_criterion3', 1, 4);
			$table->decimal('venue_criterion1', 1, 4);
			$table->decimal('venue_criterion2', 1, 4);
			$table->text('comments');
			
			$table->integer('training_id')->unsigned();
			$table->foreign('training_id')->references('id')->on('internal_trainings');

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
		Schema::drop('activity_evaluations');
	}

}
