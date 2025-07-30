<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            ['name' => 'dashboards-view','guard_name' => 'admin', 'label' => 'dashboards'],

            ['name' => 'category-view','guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-create','guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-edit','guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-delete','guard_name' => 'admin', 'label' => 'category'],

            ['name' => 'companies-view','guard_name' => 'admin', 'label' => 'companies'],
            ['name' => 'companies-create','guard_name' => 'admin', 'label' => 'companies'],
            ['name' => 'companies-edit','guard_name' => 'admin', 'label' => 'companies'],
            ['name' => 'companies-delete','guard_name' => 'admin', 'label' => 'companies'],

            ['name' => 'users-view','guard_name' => 'admin', 'label' => 'users'],
            ['name' => 'users-create','guard_name' => 'admin', 'label' => 'users'],
            ['name' => 'users-edit','guard_name' => 'admin', 'label' => 'users'],
            ['name' => 'users-delete','guard_name' => 'admin', 'label' => 'users'],

            ['name' => 'cms-users-view','guard_name' => 'admin', 'label' => 'cms-users'],
            ['name' => 'cms-users-create','guard_name' => 'admin', 'label' => 'cms-users'],
            ['name' => 'cms-users-edit','guard_name' => 'admin', 'label' => 'cms-users'],
            ['name' => 'cms-users-delete','guard_name' => 'admin', 'label' => 'cms-users'],

            ['name' => 'roles-view','guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-create','guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-edit','guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-delete','guard_name' => 'admin', 'label' => 'roles'],

            ['name' => 'permissions-view','guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-create','guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-edit','guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-delete','guard_name' => 'admin', 'label' => 'permissions'],

            ['name' => 'languages-view','guard_name' => 'admin', 'label' => 'languages'],
            ['name' => 'languages-create','guard_name' => 'admin', 'label' => 'languages'],
            ['name' => 'languages-edit','guard_name' => 'admin', 'label' => 'languages'],
            ['name' => 'languages-delete','guard_name' => 'admin', 'label' => 'languages'],

            ['name' => 'settings-view','guard_name' => 'admin', 'label' => 'settings'],

            ['name' => 'static-page-view','guard_name' => 'admin', 'label' => 'static-page'],
            ['name' => 'static-page-create','guard_name' => 'admin', 'label' => 'static-page'],
            ['name' => 'static-page-edit','guard_name' => 'admin', 'label' => 'static-page'],
            ['name' => 'static-page-delete','guard_name' => 'admin', 'label' => 'static-page'],

            ['name' => 'country-view','guard_name' => 'admin', 'label' => 'country'],
            ['name' => 'country-create','guard_name' => 'admin', 'label' => 'country'],
            ['name' => 'country-edit','guard_name' => 'admin', 'label' => 'country'],
            ['name' => 'country-delete','guard_name' => 'admin', 'label' => 'country'],

            ['name' => 'city-view','guard_name' => 'admin', 'label' => 'city'],
            ['name' => 'city-create','guard_name' => 'admin', 'label' => 'city'],
            ['name' => 'city-edit','guard_name' => 'admin', 'label' => 'city'],
            ['name' => 'city-delete','guard_name' => 'admin', 'label' => 'city'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission['name'], 'guard_name' => $permission['guard_name']],  // Şərt
                ['label' => $permission['label']]  // Yenilənəcək və ya əlavə olunacaq dəyərlər
            );
        }
    }
}
