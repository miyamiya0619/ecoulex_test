<?php
namespace App\Services;

use App\Models\Company;
use App\Models\Waterproof;
use App\Models\WaterproofWaterproofdetail;
use App\Models\Joboffer;
use App\Models\JoboffersJobofferdetail;
use App\Models\JobofferPrefecture;
use App\Models\Companieshistory;
use App\Models\CompaniesdetailsPrefecture;
use App\Models\Companiesdetail;
use App\Models\information;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminCsvImportService
{
    //会員企業データ取り込み
    public function InsertCompaniesCsvData($csvData)
    {
        //パスワードのハッシュ化
        $newPassword = Str::random(10);
        // csvファイル情報をインサートする
        $companies = new Company;
        $companies->company_id =  $this->fetchCompanyId();
        $companies->company_name = $csvData[0];
        $companies->company_name_kana = $csvData[1];
        $companies->email = $csvData[2];
        $companies->email2 = $csvData[3];
        $companies->email3 = $csvData[4];
        $companies->password = Hash::make($newPassword);
        $companies->password2 = Hash::make($newPassword);
        $companies->password3 = Hash::make($newPassword);
        $companies->user_type = 1;
        $companies->created_at = now();
        $companies->updated_at = now();
        $companies->save();
    }

    public function fetchCompanyId()
    {
        // 会社情報の取得
        $createcompany_id = Company::max('company_id') + 1;
        return $createcompany_id;
    }

    //企業情報データ,企業情報都道府県関連データ取り込み
    public function InsertCompaniesdetailCsvData($csvData,$company_id)
    {
        // csvファイル情報をインサートする
        $companiesdetail = new Companiesdetail;
        $companiesdetail->company_id =  $company_id;
        $companiesdetail->url = $csvData[2];
        $companiesdetail->address_num = $csvData[3];
        $companiesdetail->prefectureName = $csvData[4];
        $companiesdetail->addressDetail = $csvData[5];
        $companiesdetail->number_of_employees = $csvData[6];
        $companiesdetail->year_of_establishment = $csvData[7];
        $companiesdetail->capital = $csvData[8];
        $companiesdetail->representative = $csvData[9];
        $companiesdetail->phone = $csvData[10];
        $companiesdetail->form = $csvData[11];
        $companiesdetail->created_at = now();
        $companiesdetail->updated_at = now();
        $companiesdetail->save();

        // csvファイル情報をインサートする
        $companiesdetailsPrefecture = new CompaniesdetailsPrefecture;
        $companiesdetailsPrefecture->company_id =  $company_id;
        $companiesdetailsPrefecture->prefecuture_id = $csvData[12];
        $companiesdetailsPrefecture->created_at = now();
        $companiesdetailsPrefecture->updated_at = now();
        $companiesdetailsPrefecture->save();
    }

    //企業情報データ,企業情報都道府県関連データ取り込み
    public function InsertJoboffersCsvData($csvData,$company_id)
    {
        // csvファイル情報をインサートする
        $joboffers = new Joboffer;
        $joboffers->company_id =  $company_id;
        $joboffers->prefecuture_catch_head = $csvData[3];
        $joboffers->prefecuture_catch_reading = $csvData[4];
        $joboffers->prefecuture_image = $csvData[5];
        $joboffers->address_num = $csvData[6];
        $joboffers->prefectureName = $csvData[7];
        $joboffers->addressDetail = $csvData[8];
        $joboffers->working_hours = $csvData[9];
        $joboffers->monthly_income = $csvData[10];
        $joboffers->offer1_by_tel = $csvData[11];
        $joboffers->offer1_by_form = $csvData[12];
        $joboffers->offer2_by_tel = $csvData[13];
        $joboffers->offer2_by_form = $csvData[14];
        $joboffers->created_at = now();
        $joboffers->updated_at = now();
        $joboffers->save();

        // csvファイル情報をインサートする
        $jobofferPrefecture = new JobofferPrefecture;
        $jobofferPrefecture->job_id =  $company_id;
        $jobofferPrefecture->prefecuture_id = $csvData[15];
        $jobofferPrefecture->created_at = now();
        $jobofferPrefecture->updated_at = now();
        $jobofferPrefecture->save();


        
        //求人カテゴリが複数の場合
        if (strpos($csvData[2], "・") !== false) {
            $jobcat_ids = explode("・", $csvData[2]);
            foreach($jobcat_ids as $jobcat_id){
                // csvファイル情報をインサートする
                $joboffersJobofferdetail = new JoboffersJobofferdetail;
                $joboffersJobofferdetail->jobcat_id =  $jobcat_id;
                $joboffersJobofferdetail->joboffer_id = $company_id;
                $joboffersJobofferdetail->created_at = now();
                $joboffersJobofferdetail->updated_at = now();
                $joboffersJobofferdetail->save();
            }
        //求人カテゴリが単数の場合
        }else{
            // csvファイル情報をインサートする
            $joboffersJobofferdetail = new JoboffersJobofferdetail;
            $joboffersJobofferdetail->jobcat_id =  $csvData[2];
            $joboffersJobofferdetail->joboffer_id = $company_id;
            $joboffersJobofferdetail->created_at = now();
            $joboffersJobofferdetail->updated_at = now();
            $joboffersJobofferdetail->save();
        }

    }

    //防水工事と防水関連工事の取り込み
    public function importWaterProofingCsv($csvData,$company_id)
    {
        // csvファイル情報をインサートする
        $WaterProofing = new Waterproof;
        $WaterProofing->company_id =  $company_id;
        $WaterProofing->waterproofing_job_catch = $csvData[3];
        $WaterProofing->waterproofing_job_description = $csvData[4];
        $WaterProofing->waterproofing_job_image = $csvData[5];
        $WaterProofing->created_at = now();
        $WaterProofing->updated_at = now();
        $WaterProofing->save();

        //防水カテゴリが複数の場合
        if (strpos($csvData[2], "・") !== false) {
            $waterproofcat_ids = explode("・", $csvData[2]);
            foreach($waterproofcat_ids as $waterproofcat_id){
                // csvファイル情報をインサートする
                $waterproofWaterproofdetail = new WaterproofWaterproofdetail;
                $waterproofWaterproofdetail->waterproof_id =  $company_id;
                $waterproofWaterproofdetail->waterproofcat_id = $waterproofcat_id;
                $waterproofWaterproofdetail->created_at = now();
                $waterproofWaterproofdetail->updated_at = now();
                $waterproofWaterproofdetail->save();
            }
        //防水カテゴリが単数の場合
        }else{
            // csvファイル情報をインサートする
            $waterproofWaterproofdetail = new WaterproofWaterproofdetail;
            $waterproofWaterproofdetail->waterproof_id =  $company_id;
            $waterproofWaterproofdetail->waterproofcat_id = $csvData[2];
            $waterproofWaterproofdetail->created_at = now();
            $waterproofWaterproofdetail->updated_at = now();
            $waterproofWaterproofdetail->save();
        }

    }

}