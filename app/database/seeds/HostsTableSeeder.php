<?php

class HostsTableSeeder extends Seeder {

	public function run()
	{

		DB::table('hosts')->truncate();

		Host::create([
				'email' => 'cristian.conedera@gmail.com',
				'first_name' => 'Cristian',
				'last_name' => 'Conedera'
			]);

		Host::create([
				'email' => 'alejandramocoroa@gmail.com',
				'first_name' => 'Alejandra',
				'last_name' => 'Mocoroa'
			]);

	}

}
