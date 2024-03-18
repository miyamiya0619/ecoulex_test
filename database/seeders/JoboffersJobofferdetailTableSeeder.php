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
        for ($i = 1; $i <= 100; $i++) {
            $records = [];
            $numDetails = rand(2, 4);
            $selectedJobCatIds = [];
            
            while (count($records) < $numDetails) {
                $jobcat_id = rand(1, 4);
                // 同じ組み合わせが既に存在するかチェック
                $existingRecord = array_filter($records, function($record) use ($jobcat_id, $i) {
                    return $record['jobcat_id'] == $jobcat_id && $record['joboffer_id'] == $i;
                });
    
                if (empty($existingRecord)) {
                    $records[] = [
                        'jobcat_id' => $jobcat_id,
                        'joboffer_id' => $i,
                    ];
                }
            }
    
            DB::table('joboffers_jobofferdetails')->insert($records);
        }
    }
    
    
    
}
