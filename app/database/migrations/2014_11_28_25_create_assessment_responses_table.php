<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentResponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assessment_responses', function($table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->decimal('rating', 4, 1);
			$table->integer('participant_assessment_id')->unsigned();
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('assessment_responses', function($table) 
		{
      		 $table->foreign('participant_assessment_id')->references('id')->on('participant_assessments')->onDelete('cascade');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assessment_responses');
	}

}
