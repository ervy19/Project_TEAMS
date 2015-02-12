<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtQueuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('et_queues', function($table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->string('theme_topic', 255);
			$table->string('participation', 255);
			$table->string('organizer', 255);
			$table->string('venue', 255);

			$table->integer('employee_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('et_queues', function($table) 
		{
			$table->foreign('employee_id')->references('id')->on('employees');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('et_queues');
	}

}
