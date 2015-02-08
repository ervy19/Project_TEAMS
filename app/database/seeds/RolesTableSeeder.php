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
                $hrRole->name = 'HR Admin';
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

                DB::table('assigned_roles')->delete();

                $user = User::where('username','=','ervy')->first();
                $user->roles()->attach( $adminRole->id );

                $hrUser = User::where('username','=','ervy_hr')->first();
                $hrUser->roles()->attach( $hrRole->id );

                $campusSupervisorUser = User::where('username','=','ervy_csup')->first();
                $campusSupervisorUser->roles()->attach( $campusSupervisorRole->id );

                $scSupervisorUser = User::where('username','=','ervy_scsup')->first();
                $scSupervisorUser->roles()->attach( $schoolcollegeSupervisorRole->id );

                $deptSupervisorUser = User::where('username','=','ervy_dsup')->first();
                $deptSupervisorUser->roles()->attach( $departmentSupervisorRole->id );

                $progSupervisorUser = User::where('username','=','ervy_psup')->first();
                $progSupervisorUser->roles()->attach( $programSupervisorRole->id );

                $this->command->info('Roles have been assigned to User Accounts!');
	}

}
