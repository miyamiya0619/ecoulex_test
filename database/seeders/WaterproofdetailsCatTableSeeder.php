<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class WaterproofdetailsCatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['waterproofcat_id' => 1, 'catName' => '防水工事 | ウレタン防水'],
            ['waterproofcat_id' => 2, 'catName' => '防水工事 | シート系防水'],
            ['waterproofcat_id' => 3, 'catName' => '防水工事 | アスファルト系防水'],
            ['waterproofcat_id' => 4, 'catName' => '防水工事 | 金属系防水'],
            ['waterproofcat_id' => 5, 'catName' => '防水工事 | その他'],
            ['waterproofcat_id' => 6, 'catName' => '外壁補修工事各種'],
            ['waterproofcat_id' => 7, 'catName' => 'シーリング工事'],
            ['waterproofcat_id' => 8, 'catName' => '雨漏れ補修工事'],
            ['waterproofcat_id' => 9, 'catName' => '止水工事'],
            ['waterproofcat_id' => 10, 'catName' => '調査、診断 | 防水劣化調整、診断'],
            ['waterproofcat_id' => 11, 'catName' => '調査、診断 | 外壁劣化調査、診断'],
            ['waterproofcat_id' => 12, 'catName' => '調査、診断 | 耐震調査、診断'],
            ['waterproofcat_id' => 13, 'catName' => '調査、診断 | その他'],
            ['waterproofcat_id' => 14, 'catName' => '内装仕上げ工事'],
            ['waterproofcat_id' => 15, 'catName' => 'その他'],
        ];

        DB::table('waterproofdetails_cats')->insert($records);
    }
}
