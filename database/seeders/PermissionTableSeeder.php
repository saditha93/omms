<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'order-create',
            'order-edit',
            'order-delete',
            'menu-create',
            'menu-edit',
            'menu-delete',
            'item-create',
            'item-edit',
            'item-delete',
            'item-type-create',
            'item-type-edit',
            'item-type-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
//php artisan db:seed --class=PermissionTableSeeder