<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$role_sysadmin              = new Role();
		$role_sysadmin->name        = 'sysadmin';
		$role_sysadmin->description = 'Akun administrator sistem Dashvolt.';
		$role_sysadmin->save();

		$role_operator              = new Role();
		$role_operator->name        = 'operator';
		$role_operator->description = 'Akun operator yang menangani pos website.';
		$role_operator->save();
    }
}
