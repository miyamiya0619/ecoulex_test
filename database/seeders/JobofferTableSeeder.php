<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class JobofferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prefectures = ['茨城', '栃木', '群馬', '埼玉', '千葉', '東京', '神奈川', '山梨'];
        $addressDetails = ['つくば市', '宇都宮市', '前橋市', '所沢市', '柏市', '千代田区', '横浜市', '山梨市'];

        for ($i = 1; $i <= 100; $i++) {
            $prefectureIndex = ($i - 1) % count($prefectures);
            $addressIndex = ($i - 1) % count($addressDetails);

            DB::table('joboffers')->insert([
                'id' => $i,
                'company_id' => $i,
                'prefecuture_catch_head' => '求人側見出しキャッチ' . ($i - 1),
                'prefecuture_catch_reading' => '求人側本文見出し本文見出し本文見出し' . ($i - 1),
                'prefecuture_image' => 'AAA.jpg',
                'address_num' => $this->generateRandomAddressNum(),
                'prefectureName' => $prefectures[$prefectureIndex],
                'addressDetail' => $addressDetails[$addressIndex] . ($i - 1),
                'working_hours' => '9時～18時',
                'monthly_income' => '月20万',
                'offer1_by_tel' => $this->generateRandomPhoneNumber(),
                'offer1_by_form' => 'https://example' . ($i % 2 + 1) . '.com',
                'offer2_by_tel' => $this->generateRandomPhoneNumber(),
                'offer2_by_form' => 'https://example' . (($i + 1) % 2 + 1) . '.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function generateRandomAddressNum()
    {
        return rand(100, 999) . '-' . rand(1000, 9999);
    }

    private function generateRandomPhoneNumber()
    {
        return '012-' . rand(1000, 9999) . '-' . rand(1000, 9999);
    }
}
