<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@email.com';
        $admin->phone = '123456789101';
        $admin->role_id = '1';
        $admin->password = Hash::make('123456');
        $admin->save();
    }
}
