<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeederStock extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        foreach (Permission::all() as $permission) {
//            $permission->delete();
//        }

        $permissions = [
            'grn-list',
            'issue-list',
            'item-list',
            'stock-list',
            'reports-list',
            'stock-book',
            'category-list',
            'measureUnit-list',
            'supplier-list',
            'section-list',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
