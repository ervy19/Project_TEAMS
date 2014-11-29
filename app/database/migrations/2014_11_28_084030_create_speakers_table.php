<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('speakers', function($table)
		{
			$table->increments('id');
			$table->text('name', 255);
			$table->text('topic', 255);
			$table->text('educational_background', 255);
			$table->text('work_background', 255);
			
			$table->integer('training_id')->unsigned();
<<<<<<< HEAD
			
			$table->boolean(‘isActive’)->default(true);
=======
			$table->foreign('training_id')->references('id')->on('internal_trainings');

			$table->boolean('isActive')->default(true);
>>>>>>> origin/master
			$table->timestamps();
		});

		Schema::table('speakers', function($table) 
		{
			$table->foreign('training_id')->references('id')->on('internal_trainings');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('speakers');
	}

}
