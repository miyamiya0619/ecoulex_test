<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class JoboffersJobofferdetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 100; $i++) {
            DB::table('joboffers_jobofferdetails')->insert([
                'id' => $i,
                'jobcat_id' => rand(1, 4),
                'joboffer_id' => $i,
            ]);
        }
    }
}
