<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class CompaniesdetailsPrefectureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prefectureIds = [13, 14, 15, 16, 17, 18, 19, 20]; // 9種類の prefecture_id
        $count = 100; // 全体の件数

        $index = 0; // prefectureIds配列のインデックスを追跡する変数
        for ($i = 1; $i <= $count + 1; $i++) {
            $companyId = $i;
            $prefectureId = $prefectureIds[$index];

            DB::table('companiesdetails_prefectures')->insert([
                'id' => $i,
                'company_id' => $companyId,
                'prefecuture_id' => $prefectureId,
            ]);

            // prefectureIds配列のインデックスを更新し、ループさせる
            $index++;
            if ($index >= count($prefectureIds)) {
                $index = 0;
            }
        }
    }
}
