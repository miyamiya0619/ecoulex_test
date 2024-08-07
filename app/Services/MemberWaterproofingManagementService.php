<?php
namespace App\Services;

use App\Models\Company;
use App\Models\WaterproofdetailsCat;
use App\Models\Waterproof;
use App\Models\WaterproofWaterproofdetail;
use App\Models\information;

use Illuminate\Support\Facades\DB;

class MemberWaterproofingManagementService
{
    public function fetchCompanyData($company_id)
    {
        // 会社情報の取得
        $worterProofs = Company::select(
            'companies.company_id',
            'companies.company_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(JSON_OBJECT('id', wc.waterproofcat_id, 'name', wc.catName) SEPARATOR ','), ']') AS catAndIds"),
            DB::raw("JSON_ARRAYAGG(wc.waterproofcat_id) AS catIds"),
            'w.waterproofing_job_description',
            'w.waterproofing_job_catch',
            'w.waterproofing_job_image',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->leftJoin('waterproofs as w', 'w.company_id', '=', 'companies.company_id')
            ->leftJoin('waterproof_waterproofdetails as ww', 'ww.waterproof_id', '=', 'w.company_id')
            ->leftJoin('waterproofdetails_cats as wc', 'wc.waterproofcat_id', '=', 'ww.waterproofcat_id')
            ->where('companies.company_id', $company_id)
            ->groupBy(
                'companies.company_id',
                'companies.company_name',
                'w.waterproofing_job_image',
                'w.waterproofing_job_description',
                'w.waterproofing_job_catch',
            )
            ->get();

        return $worterProofs;
    }

    //防水工事カテゴリの取得
    public function fetchWaterProofingCatData()
    {
        $worterProofCatAll = WaterproofdetailsCat::all();
        return $worterProofCatAll;
    }

    //防水工事情報テーブルを取得する
    public function fetchWaterProofingData($company_id)
    {
        $waterProofingRec = Waterproof::where('company_id', $company_id)->get();
        return $waterProofingRec;
    }

    //防水情報の更新処理を行う
    public function updateWaterProofingData($company_id,$waterProofingAll,$filename)
    {

        // トランザクションを開始
        DB::beginTransaction();
            try {

        //防水工事関連テーブルを更新する（delete→insert)
        WaterproofWaterproofdetail::where('waterproof_id', $company_id)->delete();

        foreach ($waterProofingAll['WaterProofingCat'] as $waterProofingcatId) {
            WaterproofWaterproofdetail::insert([
                'waterproof_id' => $company_id,
                'waterproofcat_id' => $waterProofingcatId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        //防水工事テーブルを更新する
        $updateData = [
            'company_id' => $company_id,
            'waterproofing_job_catch' => $waterProofingAll['waterproofing_job_catch'],
            'waterproofing_job_description' => $waterProofingAll['waterproofing_job_description'],
        ];

        //prefecuture_imageに関しては、空でない場合すなわちアップロードされた場合はアップロードしたファイル名で更新する
        if (!empty($filename)) {
            $updateData['waterproofing_job_image'] = $filename;
        }

        Waterproof::where('company_id', $company_id)->update($updateData);
        
        //インフォメーションテーブルに格納し、事務局側に反映
        information::insert([
            'company_id' => $company_id,
            'information_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

            // コミット
        DB::commit();
        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();
            throw $e; // 例外を再スローして呼び出し元でエラーを処理できるようにする
        }

    }

    //防水工事情報の登録処理を行う
    public function insertWaterProofingData($company_id,$waterProofingAll,$filename){

        // トランザクションを開始
        DB::beginTransaction();
            try {

            //防水工事テーブルを登録する
            $Waterproof = new Waterproof();
            $Waterproof->company_id = $company_id;
            $Waterproof->waterproofing_job_catch = $waterProofingAll['waterproofing_job_catch'];
            $Waterproof->waterproofing_job_description = $waterProofingAll['waterproofing_job_description'];

            //prefecuture_imageに関しては、定義されている場合すなわちアップロードされた場合はアップロードしたファイル名で更新する
            if (!empty($filename)) {
                $Waterproof->waterproofing_job_image = $filename;
            }
            $Waterproof->save();

            //防水工事、防水工事カテゴリ関連テーブルを登録する
            //求人都道府県関連テーブルを更新する
            foreach ($waterProofingAll['WaterProofingCat'] as $waterProofingcatId) {
                WaterproofWaterproofdetail::insert([
                    'waterproof_id' => $company_id,
                    'waterproofcat_id' => $waterProofingcatId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            //インフォメーションテーブルに格納し、事務局側に反映
            information::insert([
                'company_id' => $company_id,
                'information_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // コミット
            DB::commit();
            } catch (\Exception $e) {
                // エラーが発生した場合はロールバック
                DB::rollBack();
                throw $e; // 例外を再スローして呼び出し元でエラーを処理できるようにする
            }
    }
}
