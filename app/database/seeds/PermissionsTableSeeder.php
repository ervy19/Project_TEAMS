<?php

class PermissionsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
/*		DB::table('permissions')->delete();

		DB::table('permissions')->insert(array(
			array(
                'name'         => 'manage_users',
                'display_name' => 'Manage Users'
            ),
            array(
                'name'         => 'manage_roles',
                'display_name' => 'Manage Roles'
            ),
            array(
                'name'         => 'manage_permissions',
                'display_name' => 'Manage Permissions'
            ),
            array(
                'name'         => 'manage_campuses',
                'display_name' => 'Manage Campuses'
            ),
            array(
                'name'         => 'manage_schools_colleges',
                'display_name' => 'Manage Schools and Colleges'
            ),
            array(
                'name'         => 'manage_departments',
                'display_name' => 'Manage Departments'
            ),
            array(
                'name'         => 'manage_skills_competencies',
                'display_name' => 'Manage Skills and Competencies'
            ),
            array(
                'name'         => 'manage_positions',
                'display_name' => 'Manage Positions'
            ),
            array(
                'name'         => 'manage_ranks',
                'display_name' => 'Manage Ranks'
            ),
            array(
                'name'         => 'manage_employees',
                'display_name' => 'Manage Employees'
            ),
            array(
                'name'         => 'manage_external_trainings',
                'display_name' => 'Manage External Trainings'
            ),
            array(
                'name'         => 'manage_internal_trainings',
                'display_name' => 'Manage Internal Trainings'
            ),
            array(
                'name'         => 'accomplish_training_assessment',
                'display_name' => 'Accomplish Training Assessment '
            ),
            array(
                'name'         => 'view_internal_training',
                'display_name' => 'View Internal Training'
            ),
            array(
                'name'         => 'view_training_info',
                'display_name' => 'View Training Information'
            ),
            array(
                'name'         => 'view_training_plan',
                'display_name' => 'View Training Plan'
            ),
            array(
                'name'         => 'view_summary_reports',
                'display_name' => 'View Summary Reports '
            )
		));

		$this->command->info('New Permissions have been created!');

		

		$admin_id = Role::where('name', '=', 'Admin')->first()->id;

        $hr_id = Role::where('name', '=', 'HR')->first()->id;

        $campussupervisor_id = Role::where('name', '=', 'Campus Supervisor')->first()->id;
/*
		/*2 = 

		$campus_supervisor_id = 

		$program_supervisor_id = 

		$schoolcollege_supervisor_id = 

		$department_supervisor_id =*/

        DB::table('permission_roles')->delete();

		DB::table('permission_roles')->insert(array(
			array(
	        	'role_id'       => 1,
	            'permission_id' => 1
            ), 
            array(
	        	'role_id'       => 1,
	            'permission_id' => 2
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 3
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 4
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 5
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 6
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 7
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 8
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 9
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 10
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 11
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 12
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 13
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 14
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 15
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 16
            ),
            array(
	        	'role_id'       => 1,
	            'permission_id' => 17
            )          
		));

        DB::table('permission_roles')->insert(array(
            array(
                'role_id'       => 2,
                'permission_id' => 1
            ), 
            array(
                'role_id'       => 2,
                'permission_id' => 1
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 3
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 4
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 5
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 6
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 7
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 8
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 9
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 10
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 11
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 11
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 13
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 14
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 15
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 16
            ),
            array(
                'role_id'       => 2,
                'permission_id' => 17
            )          
        ));

        DB::table('permission_roles')->insert(array(
            array(
                'role_id'       => 3,
                'permission_id' => 14
            ),
            array(
                'role_id'       => 3,
                'permission_id' => 15
            ),
            array(
                'role_id'       => 3,
                'permission_id' => 16
            ),
            array(
                'role_id'       => 3,
                'permission_id' => 17
            )          
        ));


	}

}