<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ranks', function($table)
		{
			$table->increments('id');
			$table->string('code', 6);
			$table->string('title', 255);
			$table->string('level', 2);

			$table->integer('position_id')->unsigned();

			$table->boolean('isActive')->default(true);
			$table->timestamps();
		});

		Schema::table('ranks', function($table) 
		{
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
		Schema::drop('ranks');
	}

}
