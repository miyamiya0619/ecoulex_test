<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class JobofferdetailCatTableSeeder extends Seeder
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
                'jobcat_id' => 1,
                'catName' => '現場作業',
            ],
            [
                'jobcat_id' => 2,
                'catName' => '現場調査診断',
            ],
            [
                'jobcat_id' => 3,
                'catName' => '現場管理監督員',
            ],
            [
                'jobcat_id' => 4,
                'catName' => '現場・営業サポート（現場事務、精算等）',
            ],

            // 必要なだけデータを追加する
        ];

        DB::table('jobofferdetail_cats')->insert($records);
    }
}
