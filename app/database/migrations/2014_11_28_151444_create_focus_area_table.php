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
		Schema::create('”focus_area”', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('instructional_strategy');
			$table->boolean('evalutaion_of_learning');
			$table->boolean('curriculum_enrichment');
			$table->boolean('research_aid_instruction');
			$table->boolean('content_update');
			$table->boolean('materials_production');
			$table->text('others', 255);

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
		Schema::drop('focus_area');
	}

}
