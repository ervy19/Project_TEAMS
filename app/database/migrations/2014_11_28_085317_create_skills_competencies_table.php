<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsCompetenciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('skills_competencies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name', 255);

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
		Schema::drop('skills_competencies');
	}

}
