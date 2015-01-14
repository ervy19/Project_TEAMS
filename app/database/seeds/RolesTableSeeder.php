<?php

class RolesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('roles')->delete();

		$adminRole = new Role;
        $adminRole->name = 'Admin';
        $adminRole->save();

        $adminRole = new Role;
        $adminRole->name = 'HR';
        $adminRole->save();

        $supervisorRole = new Role;
        $supervisorRole->name = 'Campus Supervisor';
        $supervisorRole->save();

        $supervisorRole = new Role;
        $supervisorRole->name = 'Program Supervisor';
        $supervisorRole->save();

        $supervisorRole = new Role;
        $supervisorRole->name = 'School_College Supervisor';
        $supervisorRole->save();

        $supervisorRole = new Role;
        $supervisorRole->name = 'Department Supervisor';
        $supervisorRole->save();

		$this->command->info('New Roles have been created!');
	}

}
