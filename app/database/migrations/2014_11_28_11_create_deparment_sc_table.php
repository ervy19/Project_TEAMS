<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeparmentScTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_sc', function($table)
		{
			$table->increments('id');
	
			$table->integer('skills_competencies_id')->unsigned();
			$table->integer('department_id')->unsigned();
			
			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('department_sc', function($table) 
		{
			$table->foreign('skills_competencies_id')->references('id')->on('skills_competencies');
			$table->foreign('department_id')->references('id')->on('departments');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('department_sc');
	}

}
