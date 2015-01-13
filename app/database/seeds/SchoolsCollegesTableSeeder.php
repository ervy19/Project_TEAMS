<?php

class SchoolsCollegesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('schools_colleges')->delete();

		DB::table('schools_colleges')->insert(array(
			array('name' => 'School of Accountancy & Management'),
			array('name' => 'School of Dentistry'),
			array('name' => 'School of Education, Liberal Arts, Music & Social Work'),
			array('name' => 'School of Nursing'),
			array('name' => 'School of Nutrition & Hospitality Management'),
			array('name' => 'College of Optometry'),
			array('name' => 'School of Pharmacy'),
			array('name' => 'School of Science & Technology'),
			array('name' => 'School of Law & Jurisprudence, Makati'),
			array('name' => 'College of Medical Technology'),
			array('name' => 'College of Business & Technology - Malolos'),
			array('name' => 'College of Education, Liberal Arts & Science - Malolos')			
		));

		$this->command->info('New Schools and Colleges have been created!');
	}

}
