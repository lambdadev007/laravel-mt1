<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->insert([
            'name' => 'კონსტანტა',
            'login' => 'admin',
            'password' => bcrypt('administrator'),
            'category' => 'admin',
            'soft_delete' => 'false',
        ]);
    }
}
