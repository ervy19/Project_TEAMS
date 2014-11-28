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
		Schema::create('”department_supervisors”', function(Blueprint $table)
		{
			$table->increments(‘id’);
			$table->text(‘name’, 100);
			
			$table->integer(‘deparment_id’)->unsigned();
			$table->foreign(‘department_id’)->references(‘id’)->on(‘departments’);

			$table->boolean(‘isActive’)->default(true);
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
		Schema::drop('”department_supervisors”');
	}

}
