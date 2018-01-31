<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Reset cached roles and permissions
         */
        app()['cache']->forget('spatie.permission.cache');

        /*
         * Create permissions
         */
        Permission::create(['name' => 'Administrasi Sistem']);
        Permission::create(['name' => 'Mendaftarkan pengguna']);
        Permission::create(['name' => 'Menghapus pengguna']);
        Permission::create(['name' => 'Mengubah pengguna']);
        Permission::create(['name' => 'Mendaftarkan katalog']);
        Permission::create(['name' => 'Menghapus katalog']);
        Permission::create(['name' => 'Mengubah katalog']);
        Permission::create(['name' => 'Mendaftarkan issue']);
        Permission::create(['name' => 'Menghapus issue']);
        Permission::create(['name' => 'Mengubah issue']);

        /*
         * Create roles and assign existing permissions
         */
        $admin = Role::create(['name' => 'Administrator Sistem']);
        $admin->givePermissionTo('Administrasi Sistem');
        $admin->givePermissionTo('Mendaftarkan pengguna');
        $admin->givePermissionTo('Menghapus pengguna');
        $admin->givePermissionTo('Mengubah pengguna');
        $admin->givePermissionTo('Mengubah issue');
        $admin->givePermissionTo('Menghapus issue');
        $admin->givePermissionTo('Mengubah katalog');
        $admin->givePermissionTo('Menghapus katalog');

        $it_staff = Role::create(['name' => 'IT Maintenance Staff']);
        $it_staff->givePermissionTo('Mendaftarkan issue');
        $it_staff->givePermissionTo('Mengubah issue');

        $web_operator = Role::create(['name' => 'Web Post Operator']);
        $web_operator->givePermissionTo('Mendaftarkan katalog');
        $web_operator->givePermissionTo('Mengubah katalog');

        DB::table('users')
            ->insert(
                array(
                    'name' => 'Administrator Sistem',
                    'email' => 'admin@adm.in',
                    'password' => bcrypt('katasandiku'),
                    'status' => 1,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                )
            );

        $first_user = \App\User::where('id', '=', 1)->firstOrFail();
        $first_user->assignRole('Administrator Sistem');

        if (config('app.env') == 'local') {
            factory(App\User::class, 30)->create();
        }
    }
}
