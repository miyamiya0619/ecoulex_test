<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class PrefecturesCatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $records = [
            [
                'prefecuture_id' => 1,
                'catName' => '北海道',
                'region_id' => 1,
                'regionName' => '北海道',
            ],
            [
                'prefecuture_id' => 2,
                'catName' => '青森',
                'region_id' => 2,
                'regionName' => '東北',
            ],
            [
                'prefecture_id' => 3,
                'catName' => '岩手',
                'region_id' => 2,
                'regionName' => '東北',
            ],
            [
                'prefecture_id' => 4,
                'catName' => '宮城',
                'region_id' => 2,
                'regionName' => '東北',
            ],
            [
                'prefecture_id' => 5,
                'catName' => '秋田',
                'region_id' => 2,
                'regionName' => '東北',
            ],
            [
                'prefecture_id' => 6,
                'catName' => '山形',
                'region_id' => 2,
                'regionName' => '東北',
            ],
            [
                'prefecture_id' => 7,
                'catName' => '福島',
                'region_id' => 2,
                'regionName' => '東北',
            ],
            [
                'prefecture_id' => 8,
                'catName' => '新潟',
                'region_id' => 3,
                'regionName' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 9,
                'catName' => '富山',
                'region_id' => 3,
                'regionName' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 10,
                'catName' => '石川',
                'region_id' => 3,
                'regionName' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 11,
                'catName' => '福井',
                'region_id' => 3,
                'regionName' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 12,
                'catName' => '長野',
                'region_id' => 3,
                'regionName' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 13,
                'catName' => '茨城',
                'region_id' => 4,
                'regionName' => '関東',
            ],
            [
                'prefecture_id' => 14,
                'catName' => '栃木',
                'region_id' => 4,
                'regionName' => '関東',
            ],
            [
                'prefecture_id' => 15,
                'catName' => '群馬',
                'region_id' => 4,
                'regionName' => '関東',
            ],
            [
                'prefecture_id' => 16,
                'catName' => '埼玉',
                'region_id' => 4,
                'regionName' => '関東',
            ],
            [
                'prefecture_id' => 17,
                'catName' => '千葉',
                'region_id' => 4,
                'regionName' => '関東',
            ],
            [
                'prefecture_id' => 18,
                'catName' => '東京',
                'region_id' => 4,
                'regionName' => '関東',
            ],
            [
                'prefecture_id' => 19,
                'catName' => '神奈川',
                'region_id' => 4,
                'regionName' => '関東',
            ],
            [
                'prefecture_id' => 20,
                'catName' => '山梨',
                'region_id' => 4,
                'regionName' => '関東',
            ],
            [
                'prefecture_id' => 21,
                'catName' => '岐阜',
                'region_id' => 5,
                'regionName' => '東海',
            ],
            [
                'prefecture_id' => 22,
                'catName' => '静岡',
                'region_id' => 5,
                'regionName' => '東海',
            ],
            [
                'prefecture_id' => 23,
                'catName' => '愛知',
                'region_id' => 5,
                'regionName' => '東海',
            ],
            [
                'prefecture_id' => 24,
                'catName' => '三重',
                'region_id' => 5,
                'regionName' => '東海',
            ],
            [
                'prefecture_id' => 25,
                'catName' => '滋賀',
                'region_id' => 6,
                'regionName' => '近畿',
            ],
            [
                'prefecture_id' => 26,
                'catName' => '京都',
                'region_id' => 6,
                'regionName' => '近畿',
            ],
            [
                'prefecture_id' => 27,
                'catName' => '大阪',
                'region_id' => 6,
                'regionName' => '近畿',
            ],
            [
                'prefecture_id' => 28,
                'catName' => '兵庫',
                'region_id' => 6,
                'regionName' => '近畿',
            ],
            [
                'prefecture_id' => 29,
                'catName' => '奈良',
                'region_id' => 6,
                'regionName' => '近畿',
            ],
            [
                'prefecture_id' => 30,
                'catName' => '和歌山',
                'region_id' => 6,
                'regionName' => '近畿',
            ],
            [
                'prefecture_id' => 31,
                'catName' => '鳥取',
                'region_id' => 7,
                'regionName' => '中国',
            ],
            [
                'prefecture_id' => 32,
                'catName' => '島根',
                'region_id' => 7,
                'regionName' => '中国',
            ],
            [
                'prefecture_id' => 33,
                'catName' => '岡山',
                'region_id' => 7,
                'regionName' => '中国',
            ],
            [
                'prefecture_id' => 34,
                'catName' => '広島',
                'region_id' => 7,
                'regionName' => '中国',
            ],
            [
                'prefecture_id' => 35,
                'catName' => '山口',
                'region_id' => 7,
                'regionName' => '中国',
            ],
            [
                'prefecture_id' => 36,
                'catName' => '徳島',
                'region_id' => 8,
                'regionName' => '四国',
            ],
            [
                'prefecture_id' => 37,
                'catName' => '香川',
                'region_id' => 8,
                'regionName' => '四国',
            ],
            [
                'prefecture_id' => 38,
                'catName' => '愛媛',
                'region_id' => 8,
                'regionName' => '四国',
            ],
            [
                'prefecture_id' => 39,
                'catName' => '高知',
                'region_id' => 8,
                'regionName' => '四国',
            ],
            [
                'prefecture_id' => 40,
                'catName' => '福岡',
                'region_id' => 9,
                'regionName' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 41,
                'catName' => '佐賀',
                'region_id' => 9,
                'regionName' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 42,
                'catName' => '長崎',
                'region_id' => 9,
                'regionName' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 43,
                'catName' => '熊本',
                'region_id' => 9,
                'regionName' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 44,
                'catName' => '大分',
                'region_id' => 9,
                'regionName' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 45,
                'catName' => '宮崎',
                'region_id' => 9,
                'regionName' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 46,
                'catName' => '鹿児島',
                'region_id' => 9,
                'regionName' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 47,
                'catName' => '沖縄',
                'region_id' => 9,
                'regionName' => '九州・沖縄',
            ],
        ];

        DB::table('prefectures_cats')->insert($records);
    }
}
