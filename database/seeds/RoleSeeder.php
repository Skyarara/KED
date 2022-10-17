<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'guard_name' => 'web',
            'is_active' => '1'
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
            'guard_name' => 'web',
            'is_active' => '0'
        ]);
    }
}
