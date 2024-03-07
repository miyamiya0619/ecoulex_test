<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class PrefecturesTableSeeder extends Seeder
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
                'prefecuture_id' => 1,
                'name' => '北海道',
                'region_id' => 1,
                'region' => '北海道',
            ],
            [
                'prefecuture_id' => 2,
                'name' => '青森',
                'region_id' => 2,
                'region' => '東北',
            ],
            [
                'prefecture_id' => 3,
                'name' => '岩手',
                'region_id' => 2,
                'region' => '東北',
            ],
            [
                'prefecture_id' => 4,
                'name' => '宮城',
                'region_id' => 2,
                'region' => '東北',
            ],
            [
                'prefecture_id' => 5,
                'name' => '秋田',
                'region_id' => 2,
                'region' => '東北',
            ],
            [
                'prefecture_id' => 6,
                'name' => '山形',
                'region_id' => 2,
                'region' => '東北',
            ],
            [
                'prefecture_id' => 7,
                'name' => '福島',
                'region_id' => 2,
                'region' => '東北',
            ],
            [
                'prefecture_id' => 8,
                'name' => '新潟',
                'region_id' => 3,
                'region' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 9,
                'name' => '富山',
                'region_id' => 3,
                'region' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 10,
                'name' => '石川',
                'region_id' => 3,
                'region' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 11,
                'name' => '福井',
                'region_id' => 3,
                'region' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 12,
                'name' => '長野',
                'region_id' => 3,
                'region' => '北陸・甲信越',
            ],
            [
                'prefecture_id' => 13,
                'name' => '茨城',
                'region_id' => 4,
                'region' => '関東',
            ],
            [
                'prefecture_id' => 14,
                'name' => '栃木',
                'region_id' => 4,
                'region' => '関東',
            ],
            [
                'prefecture_id' => 15,
                'name' => '群馬',
                'region_id' => 4,
                'region' => '関東',
            ],
            [
                'prefecture_id' => 16,
                'name' => '埼玉',
                'region_id' => 4,
                'region' => '関東',
            ],
            [
                'prefecture_id' => 17,
                'name' => '千葉',
                'region_id' => 4,
                'region' => '関東',
            ],
            [
                'prefecture_id' => 18,
                'name' => '東京',
                'region_id' => 4,
                'region' => '関東',
            ],
            [
                'prefecture_id' => 19,
                'name' => '神奈川',
                'region_id' => 4,
                'region' => '関東',
            ],
            [
                'prefecture_id' => 20,
                'name' => '山梨',
                'region_id' => 4,
                'region' => '関東',
            ],
            [
                'prefecture_id' => 21,
                'name' => '岐阜',
                'region_id' => 5,
                'region' => '東海',
            ],
            [
                'prefecture_id' => 22,
                'name' => '静岡',
                'region_id' => 5,
                'region' => '東海',
            ],
            [
                'prefecture_id' => 23,
                'name' => '愛知',
                'region_id' => 5,
                'region' => '東海',
            ],
            [
                'prefecture_id' => 24,
                'name' => '三重',
                'region_id' => 5,
                'region' => '東海',
            ],
            [
                'prefecture_id' => 25,
                'name' => '滋賀',
                'region_id' => 6,
                'region' => '近畿',
            ],
            [
                'prefecture_id' => 26,
                'name' => '京都',
                'region_id' => 6,
                'region' => '近畿',
            ],
            [
                'prefecture_id' => 27,
                'name' => '大阪',
                'region_id' => 6,
                'region' => '近畿',
            ],
            [
                'prefecture_id' => 28,
                'name' => '兵庫',
                'region_id' => 6,
                'region' => '近畿',
            ],
            [
                'prefecture_id' => 29,
                'name' => '奈良',
                'region_id' => 6,
                'region' => '近畿',
            ],
            [
                'prefecture_id' => 30,
                'name' => '和歌山',
                'region_id' => 6,
                'region' => '近畿',
            ],
            [
                'prefecture_id' => 31,
                'name' => '鳥取',
                'region_id' => 7,
                'region' => '中国',
            ],
            [
                'prefecture_id' => 32,
                'name' => '島根',
                'region_id' => 7,
                'region' => '中国',
            ],
            [
                'prefecture_id' => 33,
                'name' => '岡山',
                'region_id' => 7,
                'region' => '中国',
            ],
            [
                'prefecture_id' => 34,
                'name' => '広島',
                'region_id' => 7,
                'region' => '中国',
            ],
            [
                'prefecture_id' => 35,
                'name' => '山口',
                'region_id' => 7,
                'region' => '中国',
            ],
            [
                'prefecture_id' => 36,
                'name' => '徳島',
                'region_id' => 8,
                'region' => '四国',
            ],
            [
                'prefecture_id' => 37,
                'name' => '香川',
                'region_id' => 8,
                'region' => '四国',
            ],
            [
                'prefecture_id' => 38,
                'name' => '愛媛',
                'region_id' => 8,
                'region' => '四国',
            ],
            [
                'prefecture_id' => 39,
                'name' => '高知',
                'region_id' => 8,
                'region' => '四国',
            ],
            [
                'prefecture_id' => 40,
                'name' => '福岡',
                'region_id' => 9,
                'region' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 41,
                'name' => '佐賀',
                'region_id' => 9,
                'region' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 42,
                'name' => '長崎',
                'region_id' => 9,
                'region' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 43,
                'name' => '熊本',
                'region_id' => 9,
                'region' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 44,
                'name' => '大分',
                'region_id' => 9,
                'region' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 45,
                'name' => '宮崎',
                'region_id' => 9,
                'region' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 46,
                'name' => '鹿児島',
                'region_id' => 9,
                'region' => '九州・沖縄',
            ],
            [
                'prefecture_id' => 47,
                'name' => '沖縄',
                'region_id' => 9,
                'region' => '九州・沖縄',
            ],
        ];

        DB::table('prefectures_cats')->insert($records);
    }
}
