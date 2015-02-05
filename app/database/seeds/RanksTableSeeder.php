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
			array('code' => 'P1','title' => 'Professional','level' => '1','position_id' => 1),
			array('code' => 'P2','title' => 'Professional','level' => '2','position_id' => 1),
			array('code' => 'P1','title' => 'Professional','level' => '1','position_id' => 2),
			array('code' => 'P2','title' => 'Professional','level' => '2','position_id' => 2)
		));

		$this->command->info('New Ranks have been created!');
	}

}
