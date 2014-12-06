<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function($table)
		{
			$table->increments('id');
			$table->string('employee_number', 6);
			$table->string('last_name', 255);
			$table->string('given_name', 255);
			$table->string('middle_initial', 2);
			$table->string('email',255);
			$table->tinyInteger('age');
			$table->tinyInteger('tenure');

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employees');
	}

}
