<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFocusAreaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('focus_area', function($table)
		{
			$table->increments('id');
			$table->boolean('instructional_strategy');
			$table->boolean('evaluation_of_learning');
			$table->boolean('curriculum_enrichment');
			$table->boolean('research_aid_instruction');
			$table->boolean('content_update');
			$table->boolean('materials_production');
			$table->string('others', 255);

			$table->integer('internal_training_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('focus_area', function($table) 
		{
			$table->foreign('internal_training_id')->references('training_id')->on('internal_trainings');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('focus_area');
	}

}
