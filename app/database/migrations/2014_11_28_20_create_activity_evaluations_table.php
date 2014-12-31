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
		Schema::create('activity_evaluations', function($table)
		{
			$table->increments('id');
			$table->decimal('planning_criterion1', 4, 1);
			$table->decimal('planning_criterion2', 4, 1);
			$table->decimal('objectives_criterion1', 4, 1);
			$table->decimal('objectives_criterion2', 4, 1);
			$table->decimal('objectives_criterion3', 4, 1);
			$table->decimal('content_criterion1', 4, 1);
			$table->decimal('content_criterion2', 4, 1);
			$table->decimal('materials_criterion1', 4, 1);
			$table->decimal('materials_criterion2', 4, 1);
			$table->decimal('schedule_criterion1', 4, 1);
			$table->decimal('schedule_criterion2', 4, 1);
			$table->decimal('schedule_criterion3', 4, 1);
			$table->decimal('openForum_criterion1', 4, 1);
			$table->decimal('openForum_criterion2', 4, 1);
			$table->decimal('openForum_criterion3', 4, 1);
			$table->decimal('venue_criterion1', 4, 1);
			$table->decimal('venue_criterion2', 4, 1);
			$table->text('comments');
			
			$table->integer('training_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('activity_evaluations', function($table) 
		{
			$table->foreign('training_id')->references('training_id')->on('internal_trainings');
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
