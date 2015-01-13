<?php

class EmployeesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('employees')->delete();

		DB::table('employees')->insert(array(
			array('name' => ''),
			array('name' => '')		
		));

		$this->command->info('New Employees have been created!');
	}

}
