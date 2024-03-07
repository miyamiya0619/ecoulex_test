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
        for ($i = 2; $i <= 100; $i++) {
            $companyName = '宮本企業' . $i;
            $companyNameKana = 'ミヤモトキギョウ' . $i;
            $mail1 = 'miya' . $i . '00@example.com';
            $mail2 = 'miya' . $i . '00@example.com';
            $mail3 = 'miya' . $i . '00@example.com';

            DB::table('companies')->insert([
                'company_name' => $companyName,
                'company_name_kana' => $companyNameKana,
                'mail1' => $mail1,
                'mail2' => $mail2,
                'mail3' => $mail3,
                'password' => Hash::make('password'), // 仮のパスワード
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
