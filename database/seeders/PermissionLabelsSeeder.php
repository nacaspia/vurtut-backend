<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionLabelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionLabels = [
              'dashboards',
              'category',
              'companies',
              'users',
              'cms-users',
              'roles',
              'permissions',
              'languages',
              'settings',
              'static-page',
              'country',
              'city'
        ];

        foreach ($permissionLabels as $label) {
            DB::table('permission_labels')->updateOrInsert(
                ['label' => $label],   // Əgər bu "label" mövcud deyilsə
                ['label' => $label]    // Əlavə edir və ya yeniləyir
            );
        }
    }
}
