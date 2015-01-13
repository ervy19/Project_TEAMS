<?php

class PositionsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('positions')->delete();

		DB::table('positions')->insert(array(
			array('name' => ''),
			array('name' => '')		
		));

		$this->command->info('New Positions have been created!');
	}

}
