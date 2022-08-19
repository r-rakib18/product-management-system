<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role'=>'admin',
                'permissions'=>[
                    'category_create', 'category_view', 'category_edit', 'category_update',
                    'product_create', 'product_view', 'product_edit', 'product_update'
                ]
            ],
            [
                'role'=>'manager',
                'permissions'=>['category_view','product_view']
            ]
        ];

        foreach ( $roles as $role){
            $model = new Role();
            $model->role = $role['role'];
            $model->permissions= json_encode($role['permissions']);
            $model->save();
        }
    }
}
