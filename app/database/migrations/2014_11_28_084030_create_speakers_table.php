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
		Schema::create('speakers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name', 255);
			$table->text('topic', 255);
			$table->text('educational_background', 255);
			$table->text('work_background', 255);
			
			$table->integer('training_id')->unsigned();
			$table->foreign('training_id')->references('id')->on('internal_trainings');

			$table->boolean(‘isActive’)->default(true);
			$table->timestamps;
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
