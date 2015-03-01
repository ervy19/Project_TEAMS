<?php

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//DB::table('users')->delete();

		DB::table('users')->insert(array(
			array(
                'username'   => 'atafortunado@ceu.edu.ph',
                'email'      => 'atafortunado@ceu.edu.ph',
                'password'   => Hash::make('h1r1t3@ms'),
                'confirmed'  => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'username'   => 'lztambiloc@ceu.edu.ph',
                'email'      => 'lztambiloc@ceu.edu.ph',
                'password'   => Hash::make('h2r2t3@ms'),
                'confirmed'  => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
		));

		$this->command->info('New User Accounts have been created!');
	}

}
