<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentSupervisorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_supervisors', function($table)
		{
			$table->integer('supervisor_id')->unsigned();
			$table->string('name', 255);
			$table->string('title', 255);
			
			$table->integer('department_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('department_supervisors', function($table) 
		{
			$table->foreign('supervisor_id')->references('id')->on('supervisors');
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
		Schema::drop('department_supervisors');
	}

}
