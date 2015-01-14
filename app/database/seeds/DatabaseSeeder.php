<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//$this->call('CampusesTableSeeder');
		//$this->call('SchoolsCollegesTableSeeder');
		//$this->call('DepartmentsTableSeeder');
		//$this->call('PositionsTableSeeder');
		//$this->call('RanksTableSeeder');
		//$this->call('EmployeesTableSeeder');
		//$this->call('UsersTableSeeder');
		//$this->call('RolesTableSeeder');
		$this->call('PermissionsTableSeeder');

		$this->command->info('Database seeding complete!');
	}

}
