<?php

use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations = ['ST. Fruit Reception', 'ST. Sterilizer', 'ST, Thereshing', 'ST. Prss', 'ST. Klarifikasi', 'ST. Karnel'];

        foreach ($stations as $key ) {
            DB::table('stations')->insert([
                [
                    'name' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        }
    }
}
