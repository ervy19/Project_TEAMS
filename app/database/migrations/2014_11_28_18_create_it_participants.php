<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItParticipants extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_participants', function($table)
		{
			$table->increments('id');
			
			$table->datetime('time')->nullable();

			$table->integer('employee_id')->unsigned();
			$table->integer('internal_training_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('it_participants', function($table) 
		{
      		$table->foreign('employee_id')->references('id')->on('employees');
      		$table->foreign('internal_training_id')->references('id')->on('internal_trainings');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('it_participants');
	}

}
