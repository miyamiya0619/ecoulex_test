<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加

class CompaniesdetailTableSeeder extends Seeder
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
            $company_id = $i;
            $url = 'https://example.com/' . $i;
            $address_num = rand(100, 999) . '-' . rand(1000, 9999);
            $prefectureIndex = ($i - 1) % count($prefectures);
            $addressIndex = ($i - 1) % count($addressDetails);
            $prefectureName = $prefectures[$prefectureIndex];
            $addressDetail = $addressDetails[$addressIndex] . $i . '-' . $i . '-' . $i;
            $number_of_employees = rand(10, 500) . '人';
            $year_of_establishment = rand(1970, 2020) . '年';
            $capital = rand(10, 100) . '万円';
            $representative = '代表者' . $i;
            $phone = '012-3456-' . sprintf("%04d", rand(0, 9999));
            $form = '株式会社' . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90));

            DB::table('companiesdetails')->insert([
                'company_id' => $company_id,
                'url' => $url,
                'address_num' => $address_num,
                'prefectureName' => $prefectureName,
                'addressDetail' => $addressDetail,
                'number_of_employees' => $number_of_employees,
                'year_of_establishment' => $year_of_establishment,
                'capital' => $capital,
                'representative' => $representative,
                'phone' => $phone,
                'form' => $form,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

