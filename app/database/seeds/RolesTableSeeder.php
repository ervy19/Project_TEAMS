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

                $hrRole = new Role;
                $hrRole->name = 'HR';
                $hrRole->save();

                $campusSupervisorRole = new Role;
                $campusSupervisorRole->name = 'Campus Supervisor';
                $campusSupervisorRole->save();

                $programSupervisorRole = new Role;
                $programSupervisorRole->name = 'Program Supervisor';
                $programSupervisorRole->save();

                $schoolcollegeSupervisorRole = new Role;
                $schoolcollegeSupervisorRole->name = 'School_College Supervisor';
                $schoolcollegeSupervisorRole->save();

                $departmentSupervisorRole = new Role;
                $departmentSupervisorRole->name = 'Department Supervisor';
                $departmentSupervisorRole->save();

		$this->command->info('New Roles have been created!');

                $user = User::where('username','=','ervy')->first();
                $user->attachRole( $adminRole );

                /*DB::table('assigned_roles')->insert(array(
                        array(
                                'user_id' => 2,
                                'role_id' => 2
                        ),
                        array(
                                'user_id' => 3,
                                'role_id' => 3
                        )
                ));*/

                $hrUser = User::where('username','=','ervy_hr')->first();
                $hrUser->attachRole( $hrRole );

                $supervisorUser = User::where('username','=','ervy_supervisor')->first();
                $supervisorUser->attachRole( $campusSupervisorRole );
	}

}
