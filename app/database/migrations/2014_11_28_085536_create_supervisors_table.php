<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supervisors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text(‘name’, 255);
			$table->char(‘supervisor_type’, 2);

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
		Schema::drop('supervisors');
	}

}
