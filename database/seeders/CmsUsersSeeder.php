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
            'phone' => '0507027093',
            'password' => bcrypt('123456'),
            'status' => 1
        ]);
    }
}
