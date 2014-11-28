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
		Schema::create('et_addressed_sc', function(Blueprint $table)
		{
			$table->increments('id');
	
			$table->integer('skills_competencies_id')->unsigned();
			$table->foreign('skills_competencies_id')->references('id')->on('skills_competencies');
			
			$table->integer('internal_training_id')->unsigned();
			$table->foreign('external_training_id')->references('id')->on('external_trainings');
			
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
		Schema::drop('et_addressed_sc');
	}

}
