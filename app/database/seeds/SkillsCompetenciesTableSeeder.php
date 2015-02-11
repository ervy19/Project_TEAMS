<?php

class SkillsCompetenciesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('skills_competencies')->delete();

		DB::table('skills_competencies')->insert(array(
			array('name' => 'Performing Basic Desktop Operations', 'description' => NULL),
			array('name' => 'Utilizing Google Apps', 'description' => 'Mail, Drive, Spreadsheets, Forms, Calendar, etc.'),
			array('name' => 'Ensuring Data Security (Back-up)', 'description' => NULL),
			array('name' => 'Using Word', 'description' => NULL),
			array('name' => 'Using Excel', 'description' => NULL),
			array('name' => 'Using Powerpoint', 'description' => NULL),
			array('name' => 'Relating with Customers', 'description' => NULL),
			array('name' => 'Facilitating and Participating in Discussions', 'description' => NULL),
			array('name' => 'Recording Minutes of Meetings', 'description' => NULL),
			array('name' => 'Writing Business Correspondence/e-Correspondence', 'description' => NULL),
			array('name' => 'Preparing Reportorial Requirements', 'description' => NULL),
			array('name' => 'Filling-out of Forms', 'description' => NULL),
			array('name' => 'Gathering and Analyzing Data', 'description' => NULL),
			array('name' => 'Transforming Data to Information', 'description' => NULL),
			array('name' => 'Managing Financial Resource', 'description' => 'e.g. Budgeting, Disbursement, Liquidation'),
			array('name' => 'Managing Office Resources', 'description' => 'e.g. Requisition and Use of Office Supplies, Proper Use and Maintenance of Office Equipment and Inventory')
		));
			
		DB::table('skills_competencies')->insert(array(
			array('name' => 'Practicing Good Grooming, Power Dressing, Social Graces, and Etiquette', 'description' => NULL),
			array('name' => 'Building Rapport', 'description' => NULL),
			array('name' => 'Observing Proper Communication Channels', 'description' => NULL),
			array('name' => 'Effective Interpersonal and Group Communication', 'description' => 'Cooperative Deliberation, Facilitation, Negotiation'),
			array('name' => 'Strengthening Spirituality', 'description' => NULL),
			array('name' => 'Reinforcing Values', 'description' => "CEU's Core Values"),
			array('name' => 'Promoting Health and Wellness', 'description' => NULL),
			array('name' => 'Developing Life Skills', 'description' => 'Problem Solving, Decision Making, Managing Change'),
			array('name' => 'Managing Stress, Conflict, Anger, and Time (SCAT)', 'description' => NULL),
			array('name' => 'Acquiring Organizational Skills', 'description' => 'Innovation, Leadership'),
			array('name' => 'Managing Personal Finances', 'description' => NULL),
			array('name' => 'Readiness for Emergencies', 'description' => 'Fire, Earthquake, Disaster/Calamities')
		));

		DB::table('skills_competencies')->insert(array(
			array('name' => 'Learning Environment', 'description' => 'Creating a safe, secured, friendly, and non-threatening atmosphere'),
			array('name' => 'Diversity of Learners', 'description' => 'Recognizing the individual differences in learning'),
			array('name' => 'Curriculum Development', 'description' => 'Setting and communicating learning goal using appropriate teaching methods, learning activities and instructional materials and resources'),
			array('name' => 'Assessing and Reporting', 'description' => 'Using appropriate strategies in assessing, monitoring, and reporting learning outcomes'),
			array('name' => 'Social Regard for Learning', 'description' => 'Demonstrating and exemplifying the value of learning'),
			array('name' => 'Utilizining Social Media and Google Applications', 'description' => 'Mail, Drive, Spreadsheets, etc.'),
			array('name' => 'Using Search Engines for Teaching and Learning', 'description' => NULL),
			array('name' => 'Administering Learning Management Systems', 'description' => NULL),
			array('name' => 'Employing Productivity Applications/Systems for Instruction and Assessment', 'description' => 'Excel, Word, Powerpointm, etc.'),
			array('name' => 'Utilizing Massive Open Online Courses (MOOCs) for Professional Development', 'description' => NULL),
			array('name' => 'Communication Skills', 'description' => 'Grammar, Pronunciation, Speech, etc.', 'description' => NULL),
			array('name' => 'Presentation Skills', 'description' => NULL),
			array('name' => 'Facilitating Skills', 'description' => NULL),
			array('name' => 'Business Correspondence/e-Correspondence', 'description' => NULL),
			array('name' => 'Reportorial Requirements', 'description' => NULL),
			array('name' => 'Writing for Instructional Materials/Resources', 'description' => NULL),
			array('name' => 'Writing Research Proposal', 'description' => NULL),
			array('name' => 'Research Design', 'description' => NULL),
			array('name' => 'Writing for Publication', 'description' => NULL),
			array('name' => 'Patenting', 'description' => NULL),
			array('name' => 'Strategies in Establishing/Strengthening Partnerships', 'description' => NULL)
		));

		$this->command->info('New Skills & Competencies have been created!');
	}
}
