<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'account_uuid' => 1,
            'account_name' => 'test_user',
            'login_id' => 'test_login_id',
            'email' => 'test@email.com',
            'password' => Hash::make('password'),
            'delete_flg' => 0,
            'user_roll' => 10,
            'deleted_at' => now(),
        ]);
    }
}