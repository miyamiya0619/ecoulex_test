<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class WaterproofWaterproofdetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $records = [];
            $numDetails = rand(2, 15);
            for ($j = 0; $j < $numDetails; $j++) {
                $waterproofcat_id = rand(1, 15);
                // 重複をチェックして追加する
                if (!$this->existsRecord($i, $waterproofcat_id, $records)) {
                    $records[] = [
                        'waterproof_id' => $i,
                        'waterproofcat_id' => $waterproofcat_id,
                    ];
                }
            }
            DB::table('waterproof_waterproofdetails')->insert($records);
        }
    }

    // 重複をチェックするメソッド
    private function existsRecord($waterproof_id, $waterproofcat_id, $records)
    {
        foreach ($records as $record) {
            if ($record['waterproof_id'] == $waterproof_id && $record['waterproofcat_id'] == $waterproofcat_id) {
                return true;
            }
        }
        return false;
    }
}