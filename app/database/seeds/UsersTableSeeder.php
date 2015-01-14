<?php

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();

		DB::table('users')->insert(array(
			array(
                'username'   => 'ervy',
                'email'      => 'ervy@ervyabut.com',
                'password'   => Hash::make('admin'),
                'confirmed'  => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'username'   => 'ervy_hr',
                'email'      => 'ervy_hr@ervyabut.com',
                'password'   => Hash::make('hr'),
                'confirmed'  => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
			array(
                'username'   => 'ervy_supervisor',
                'email'      => 'ervy_supervisor@ervyabut.com',
                'password'   => Hash::make('supervisor'),
                'confirmed'  => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )	
		));

		$this->command->info('New User Accounts have been created!');
	}

}
