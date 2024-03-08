<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class WaterproofTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('waterproofs')->insert([
                'id' => $i,
                'company_id' => $i,
                'waterproofing_job_description' => '防水見出しキャッチ' . $i,
                'waterproofing_job_catch' => '防水本文見出し本文見出し本文見出し' . $i,
                'waterproofing_job_image' => 'BBB.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}




