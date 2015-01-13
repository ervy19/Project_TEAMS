<?php

class DepartmentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('departments')->delete();

		DB::table('departments')->insert(array(
			array('name' => 'Filipino', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Physical Education', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'International Languages', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Mathematics', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Psychology', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Library Science', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'University Publications', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Computer Science', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Biological Science', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Physical Sciences', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Social Sciences', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Social Arts, Humanities and Theology', 'isAcademic' => '1', 'schools_colleges_id' => NULL),
			array('name' => 'Property', 'isAcademic' => '0', 'schools_colleges_id' => NULL),
			array('name' => 'PACE/Education Program', 'isAcademic' => '0', 'schools_colleges_id' => NULL),
			array('name' => 'Recruitment & Placement - Malolos', 'isAcademic' => '0', 'schools_colleges_id' => NULL),
			array('name' => 'Auxiliary Services', 'isAcademic' => '0', 'schools_colleges_id' => NULL),
			array('name' => 'Planning and Monitoring', 'isAcademic' => '0', 'schools_colleges_id' => NULL),
			array('name' => 'Marketing Communications', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Health Services', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Alumni Relations', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Security', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Information & Communications Technology', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'NSTP/Community Outreach', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Records Management', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Clinical Laboratory', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Guidance and Counseling ', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Human Resources', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Internal Audit', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Cash', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Student Records Management', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Accounting', 'isAcademic' => '0', 'schools_colleges_id' => NULL),	
			array('name' => 'Multimedia Instructional Assistance', 'isAcademic' => '0', 'schools_colleges_id' => NULL)
		));

		$this->command->info('New Departments have been created!');
	}

}
