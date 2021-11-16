<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

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
            'user_id' => '000001',
            'username' => 'Administrator',
            'firstname' => 'Super',
            'lastname' => 'User',
            'phone' => '00000000000',
            'email' => 'admin@yopmail.com',
            'gender' => 'male',
            'password' => bcrypt('password'),
            'evc' => '000011',
            'referral_code' => '202019',
        ]);
        DB::table('records')->insert([
            'user_id' => '000001',
            'stage' => 1,
            'downline_brought' => 0,
            'downline_left' => 1,
        ]);
        DB::table('proofs')->insert([
            'mid' => '000001',
            'pid' => '242423',
            'file' => 'test',
            'note' => 'test',
        ]);
    }
}
