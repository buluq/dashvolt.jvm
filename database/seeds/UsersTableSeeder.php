<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\User::class, 30)->create();

		$roles = App\Role::all();

		App\User::all()->each(function($user) use ($roles) {
			$user->roles()->attach(
				$roles->random(rand(1, 2))->pluck('id')->toArray()
			);
		});
    }
}
