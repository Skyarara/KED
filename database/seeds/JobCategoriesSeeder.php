<?php

use Illuminate\Database\Seeder;

class JobCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_categories')->insert([
            'name' => 'PCM',
            'short_name' => 'PCM'
        ]);

        DB::table('job_categories')->insert([
            'name' => 'UPCM',
            'short_name' => 'UPCM'
        ]);
    }
}
