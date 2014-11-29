<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assessment_items', function($table)
		{
			$table->increments('id');
			$table->text('name', 255);
			$table->decimal('rating', 1, 4);
		
			$table->integer('participant_assessment_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('assessment_items', function($table) 
		{
      		 $table->foreign('participant_assessment_id')->references('id')->on('participant_assessments');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assessment_items');
	}

}
