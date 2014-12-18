<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('participant_attendances', function($table)
		{
			$table->increments('id');

			$table->date('date');
			$table->time('time');			
			$table->integer('it_participant_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('participant_attendances', function($table) 
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
		Schema::drop('participant_attendances');
	}

}
