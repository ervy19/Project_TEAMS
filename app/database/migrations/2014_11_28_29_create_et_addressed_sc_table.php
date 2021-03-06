<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtAddressedScTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('et_addressed_sc', function($table)
		{
			$table->increments('id');
	
			$table->integer('skills_competencies_id')->unsigned();
			$table->integer('external_training_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('et_addressed_sc', function($table) 
		{
			$table->foreign('skills_competencies_id')->references('id')->on('skills_competencies');
			$table->foreign('external_training_id')->references('training_id')->on('external_trainings');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('et_addressed_sc');
	}

}
