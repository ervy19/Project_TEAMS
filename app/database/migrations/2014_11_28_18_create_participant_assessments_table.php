<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantAssessmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('participant_assessments', function($table)
		{
			$table->increments('id');
			$table->string('type', 20);
			$table->decimal('rating', 4, 1)->nullable();
			$table->text('verbal_interpretation')->nullable();
			$table->text('remarks')->nullable();
			
			$table->integer('it_participant_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('participant_assessments', function($table) 
		{
      		$table->foreign('it_participant_id')->references('id')->on('it_participants');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('participant_assessments');
	}

}
