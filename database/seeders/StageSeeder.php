<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 5; $i++) {
            DB::table('stages')->insert([
                'sid' => $i,
                'downline' => pow(2, $i),
                'amount' => 1000 * pow(2, $i),
            ]);
        }
    }
}
