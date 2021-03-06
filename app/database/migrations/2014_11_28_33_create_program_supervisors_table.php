<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramSupervisorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('program_supervisors', function($table)
		{
			$table->integer('supervisor_id')->unsigned();
			
			$table->integer('campus_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('program_supervisors', function($table) 
		{
			$table->primary('supervisor_id');
			$table->foreign('supervisor_id')->references('id')->on('supervisors');
			$table->foreign('campus_id')->references('id')->on('campuses');
  		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('program_supervisors');
	}

}
