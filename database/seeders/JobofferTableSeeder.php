<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class JobofferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('joboffers')->insert([
                'id' => $i,
                'company_id' => $i,
                'prefecuture_catch_head' => '見出しキャッチ' . ($i - 1),
                'prefecuture_catch_reading' => '本文見出し本文見出し本文見出し' . ($i - 1),
                'prefecuture_image' => 'AAA.jpg',
                'locate' => '勤務地' . ($i - 1),
                'working_hours' => '9時～18時',
                'monthly_income' => '月20万',
                'offer1_by_tel' => '012-1111-7890',
                'offer1_by_form' => 'https://example1.com',
                'offer2_by_tel' => '012-2222-3333',
                'offer2_by_form' => 'https://example2.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

