<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_roles')->insert([
            'id' => '1',
            'name' => 'manager',
            'fa_name' => 'مدیر',
        ]);
        DB::table('admins')->insert([
            'id' => '1',
            'name' => 'مریم',
            'family' => 'سوری',
            'email' => 'maryam@gmail.com',
            'mobile' => '09307347918',
            'password' => Hash::make('123456789'),
            'access_status' => true,
            'admin_role_id' => '1',
            // 'remember_token' => Hash::make('987654321'),
        ]);
    }
}
