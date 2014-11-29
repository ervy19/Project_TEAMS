<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItAddressedScTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_addressed_sc', function($table)
		{
			$table->increments('id');
	
			$table->integer('skills_competencies_id')->unsigned();
			$table->integer('internal_training_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('it_addressed_sc', function($table) 
		{
			$table->foreign('skills_competencies_id')->references('id')->on('skills_competencies');
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
		Schema::drop('it_addressed_sc');
	}

}
