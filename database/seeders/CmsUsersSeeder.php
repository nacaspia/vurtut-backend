<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_users')->insert([
            'type' => 'super_admin',
            'name' => 'Vurtut',
            'surname' => 'Admin',
            'email' => 'admin@vurtut.com',
            'phone' => '+994552956727',
            'password' => bcrypt('Nacaspia@2025@010601140901@vtis.IGG'),
            'status' => 1
        ]);
    }
}
