<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new User();
        $manager->name = 'Manager';
        $manager->email = 'manager@email.com';
        $manager->phone = '123456789102';
        $manager->role_id = '2';
        $manager->password = Hash::make('123456');
        $manager->save();
    }
}
