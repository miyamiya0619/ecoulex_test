<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 2; $i++) {
            $companyName = '宮本事務局' . $i;
            $companyNameKana = 'ミヤモトジムキョク' . $i;
            $mail1 = 'miyajimu' . $i . '00@example.com';
            $mail2 = 'miyajimu' . $i . '00@example.com';
            $mail3 = 'miyajimu' . $i . '00@example.com';

            DB::table('companies')->insert([
                'company_name' => $companyName,
                'company_name_kana' => $companyNameKana,
                'email' => $mail1,
                'email2' => $mail2,
                'email3' => $mail3,
                'password' => Hash::make('password'), // 仮のパスワード
                'user_type'=> '2',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
