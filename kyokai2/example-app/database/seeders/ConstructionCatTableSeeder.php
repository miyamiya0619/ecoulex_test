<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class ConstructionCatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'cat_id' => 1,
                'cat_name' => '防水工事',
            ],
            [
                'cat_id' => 2,
                'cat_name' => '外壁補修工事各種',
            ],
            [
                'cat_id' => 3,
                'cat_name' => 'シーリング工事',
            ],
            [
                'cat_id' => 4,
                'cat_name' => '雨漏れ補修工事',
            ],
            [
                'cat_id' => 5,
                'cat_name' => '止水工事',
            ],
            [
                'cat_id' => 6,
                'cat_name' => '調査、診断',
            ],
            [
                'cat_id' => 7,
                'cat_name' => '内装仕上げ工事',
            ],
            [
                'cat_id' => 8,
                'cat_name' => 'その他',
            ],
            // 必要なだけデータを追加する
        ];

        DB::table('construction_cats')->insert($records);

        // レコードを削除
        // DB::table('construction_cat')->delete();
    }
}
