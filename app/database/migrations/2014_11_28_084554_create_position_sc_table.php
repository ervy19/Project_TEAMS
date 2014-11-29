<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionScTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('position_sc', function($table)
		{
			$table->increments('id');
	
			$table->integer('skills_competencies_id')->unsigned();
			$table->integer('position_id')->unsigned();

			$table->boolean(‘isActive’)->default(true);
			$table->timestamps();
		});

		Schema::table('position_sc', function($table) 
		{
			$table->foreign('skills_competencies_id')->references('id')->on('skills_competencies');
			$table->foreign('position_id')->references('id')->on('positions');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('position_sc');
	}

}
