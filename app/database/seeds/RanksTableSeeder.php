<?php

class RanksTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('ranks')->delete();

		DB::table('ranks')->insert(array(
			array('name' => ''),
			array('name' => '')		
		));

		$this->command->info('New Ranks have been created!');
	}

}
