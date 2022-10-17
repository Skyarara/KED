<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate([
            'username' => 'admin',
            'password' => bcrypt('123123'),
            'is_active' => '1'
        ]);

        $user->assignRole('Admin');

        DB::table('user_profiles')->insert([
            'employee_number' => '0001',
            'name' => 'Admin ',
            'phone' => '000000000000',
            'address' => 'Jl. Street',
            'is_mechanic' => '1',
            'user_id' => '1'
        ]);

        $users = User::firstOrCreate([
            'username' => 'joni',
            'password' => bcrypt('user1234'),
            'is_active' => '1'
        ]);

        $users->assignRole('User');

        DB::table('user_profiles')->insert([
            'employee_number' => '1234',
            'name' => 'Joni',
            'phone' => '8525252525252',
            'address' => 'Jl. Street',
            'is_mechanic' => '1',
            'user_id' => '2'
        ]);

        $users = User::firstOrCreate([
            'username' => 'imam',
            'password' => bcrypt('user1234'),
            'is_active' => '1'
        ]);

        $users->assignRole('User');

        DB::table('user_profiles')->insert([
            'employee_number' => '2367',
            'name' => 'Imam',
            'phone' => '8525252525252',
            'address' => 'Jl. Street',
            'is_mechanic' => '1',
            'user_id' => '3'
        ]);

        $users = User::firstOrCreate([
            'username' => 'aris',
            'password' => bcrypt('user1234'),
            'is_active' => '1'
        ]);

        $users->assignRole('User');

        DB::table('user_profiles')->insert([
            'employee_number' => '56789',
            'name' => 'Aris',
            'phone' => '8525252525252',
            'address' => 'Jl. Street',
            'is_mechanic' => '1',
            'user_id' => '4'
        ]);

        $users = User::firstOrCreate([
            'username' => 'muji',
            'password' => bcrypt('user1234'),
            'is_active' => '1'
        ]);

        $users->assignRole('User');

        DB::table('user_profiles')->insert([
            'employee_number' => '67854',
            'name' => 'Muji',
            'phone' => '8525252525252',
            'address' => 'Jl. Street',
            'is_mechanic' => '1',
            'user_id' => '5'
        ]);
    }
}
