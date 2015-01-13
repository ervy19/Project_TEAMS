<?php

class CampusesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('campuses')->delete();

		DB::table('campuses')->insert(array(
			array('name' => 'Manila', 'address' => '9 Mendiola St., San Miguel, Manila' ),
			array('name' => 'Malolos', 'address' => 'Km 44 Mc Arthur Highway, Malolos, Bulacan' ),
			array('name' => 'Makati - Gil Puyat', 'address' => '259 Senator Gil Puyat Ave., Makati City' ),
			array('name' => 'Makati - Legaspi', 'address' => '103 Esteban St., corner Legaspi St., Makati City' )
		));

		$this->command->info('New campuses have been created!');
	}

}
