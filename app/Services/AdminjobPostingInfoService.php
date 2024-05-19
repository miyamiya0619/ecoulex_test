<?php
namespace App\Services;

use App\Models\Company;
use App\Models\Waterproof;
use App\Models\WaterproofWaterproofdetail;
use App\Models\Joboffer;
use App\Models\JoboffersJobofferdetail;
use App\Models\JobofferPrefecture;
use App\Models\JobofferdetailCat;
use App\Models\PrefecturesCat;
use App\Models\Companieshistory;
use App\Models\CompaniesdetailsPrefecture;
use App\Models\Companiesdetail;
use App\Models\information;
use Illuminate\Support\Facades\DB;

class AdminjobPostingInfoService
{
    public function fetchCompanyDetailData()
    {
        // 会社情報の取得
        $jobPostings = DB::table('joboffers as jo')
            ->leftJoin('companiesdetails as cd', 'jo.company_id', '=', 'cd.company_id')
            ->leftJoin('companies as cp', 'cp.company_id', '=', 'cd.company_id')
            ->select('cp.company_id','cp.company_name', 'jo.updated_at')
            ->where('cp.user_type', 1)
            ->orderBy('cp.company_id' , 'desc')
            ->paginate(10);

        return $jobPostings;
    }

    public function fetchCompanyData($company_id)
    {
        $jobPostings = Company::select(
            'companies.company_id',
            'companies.company_name',
            DB::raw('COALESCE(CONCAT(\'[\', GROUP_CONCAT(JSON_OBJECT(\'jobcat_id\', jc.jobcat_id, \'catName\', jc.catName) SEPARATOR \',\'), \']\'), \'[]\') AS catAndIds'),
            'jo.prefecuture_image',
            'jo.prefecuture_catch_head',
            'jo.prefecuture_catch_reading',
            'jo.address_num',
            'jo.prefectureName',
            'jo.addressDetail',
            'jo.working_hours',
            'jo.monthly_income',
            'jo.offer1_by_tel',
            'jo.offer1_by_form',
            'jo.offer2_by_tel',
            'jo.offer2_by_form',
            'jp.prefecuture_id',
        )
         ->leftJoin('companiesdetails AS cd', 'cd.company_id', '=', 'companies.company_id')
        ->leftJoin('joboffers AS jo', 'jo.company_id', '=', 'companies.company_id')
        ->leftJoin('joboffers_jobofferdetails AS jj', 'jj.joboffer_id', '=', 'jo.company_id')
        ->leftJoin('jobofferdetail_cats AS jc', 'jc.jobcat_id', '=', 'jj.jobcat_id')
        ->leftJoin('joboffer_prefectures as jp', 'jp.job_id', '=', 'jo.company_id')
        ->where('companies.company_id', $company_id)
        ->groupBy(
            'companies.company_id',
            'companies.company_name',
            'jo.prefecuture_image',
            'jo.prefecuture_catch_head',
            'jo.prefecuture_catch_reading',
            'jo.address_num',
            'jo.prefectureName',
            'jo.addressDetail',
            'jo.working_hours',
            'jo.monthly_income',
            'jo.offer1_by_tel',
            'jo.offer1_by_form',
            'jo.offer2_by_tel',
            'jo.offer2_by_form',
            'jp.prefecuture_id',
        )->get();

        return $jobPostings;
    }

    // 求人カテゴリ情報の取得
    public function fetchJobofferdetailCatsData()
    {
        $JobofferdetailCatAll = JobofferdetailCat::all();
        return $JobofferdetailCatAll;
    }

    //カテゴリを全件取得
    public function fetchPrefecturesCatsData()
    {
        $PrefecturesCats = PrefecturesCat::all();
        return $PrefecturesCats;
    }


    //求人管理更新処理

    public function updateEditAdminjobPostingInfo($company_id,$jobPostingAll,$filename)
    {

        //求人募集内容関連テーブルを更新する（delete→insert)
        JoboffersJobofferdetail::where('joboffer_id', $company_id)->delete();

        if(!empty($jobPostingAll['JobofferdetailCat']))
        {
            foreach ($jobPostingAll['JobofferdetailCat'] as $jobcatId) {
                JoboffersJobofferdetail::insert([
                    'jobcat_id' => $jobcatId,
                    'joboffer_id' => $company_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        //求人都道府県テーブルを更新する
        JobofferPrefecture::where('job_id', $company_id)->update(['prefecuture_id' => $jobPostingAll['prefectureId']]);

        //prefectureIdからprefectureNameを取得する
        $prefectureName = PrefecturesCat::select('catName')->where('prefecuture_id', $jobPostingAll['prefectureId'])->get();
        

        //求人情報テーブルを更新する
        $updateData = [
            'prefecuture_catch_head' => $jobPostingAll['prefecuture_catch_head'],
            'prefecuture_catch_reading' => $jobPostingAll['prefecuture_catch_reading'],
            // 'address_num' => $jobPostingAll['address_num'],
            'prefectureName' => $prefectureName[0]->catName,
            'addressDetail' => $jobPostingAll['addressDetail'],
            'working_hours' => $jobPostingAll['working_hours'],
            'monthly_income' => $jobPostingAll['monthly_income'],
            'offer1_by_tel' => $jobPostingAll['offer1_by_tel'],
            'offer1_by_form' => $jobPostingAll['offer1_by_form'],
            'offer2_by_tel' => $jobPostingAll['offer2_by_tel'],
            'offer2_by_form' => $jobPostingAll['offer2_by_form']
        ];

        //prefecuture_imageに関しては、定義されている場合すなわちアップロードされた場合はアップロードしたファイル名で更新する
        if (!empty($filename)) {
            $updateData['prefecuture_image'] = $filename;
        }

        //インフォメーションテーブルに格納し、事務局側に反映
        information::insert([
            'company_id' => $company_id,
            'information_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Joboffer::where('company_id', $company_id)->update($updateData);
    }

    //会員企業管理削除処理
    public function deleteAdminjobPostingData($delEditAdminjobPostingInfo)
    {
                // トランザクションを開始
    DB::beginTransaction();
    try {

        //求人情報関連の削除
        JoboffersJobofferdetail::where('joboffer_id', $delEditAdminjobPostingInfo['company_id']) ->delete();

        //防水都道府県情報の削除
        JobofferPrefecture::where('job_id', $delEditAdminjobPostingInfo['company_id']) ->delete();
        
        //求人情報の削除
        Joboffer::where('company_id', $delEditAdminjobPostingInfo['company_id']) ->delete();

        // コミット
        DB::commit();
    }catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();
            throw $e; // 例外を再スローして呼び出し元でエラーを処理できるようにする
        }
    
    }

    //求人情報テーブルを取得する
    public function fetchJobPostingData($company_id)
    {
        $jobPostingRec = Joboffer::where('company_id', $company_id)->get();
        return $jobPostingRec;
    }

    //求人情報の登録処理を行う
    public function insertJobPostingData($company_id,$jobPostingAll,$filename){

        // トランザクションを開始
        DB::beginTransaction();
            try {
            //prefectureIdからprefectureNameを取得する
            $prefectureName = PrefecturesCat::select('catName')->where('prefecuture_id', $jobPostingAll['prefectureId'])->get();

            //求人都道府県テーブルを登録する
            $Joboffer = new Joboffer();
            $Joboffer->company_id = $company_id;
            $Joboffer->prefecuture_catch_head = $jobPostingAll['prefecuture_catch_head'];
            $Joboffer->prefecuture_catch_reading = $jobPostingAll['prefecuture_catch_reading'];
            // $Joboffer->address_num =  $jobPostingAll['address_num'];
            $Joboffer->prefectureName = $prefectureName[0]->catName;
            $Joboffer->addressDetail = $jobPostingAll['addressDetail'];
            $Joboffer->working_hours = $jobPostingAll['working_hours'];
            $Joboffer->monthly_income = $jobPostingAll['monthly_income'];
            $Joboffer->offer1_by_tel = $jobPostingAll['offer1_by_tel'];
            $Joboffer->offer1_by_form = $jobPostingAll['offer1_by_form'];
            $Joboffer->offer2_by_tel = $jobPostingAll['offer2_by_tel'];
            $Joboffer->offer2_by_form = $jobPostingAll['offer2_by_form'];
            //prefecuture_imageに関しては、定義されている場合すなわちアップロードされた場合はアップロードしたファイル名で更新する
            if (!empty($filename)) {
                $Joboffer->prefecuture_image = $filename;
            }
            $Joboffer->save();


            //求人都道府県関連テーブルを更新する
            foreach ($jobPostingAll['JobofferdetailCat'] as $jobcatId) {
                JoboffersJobofferdetail::insert([
                    'jobcat_id' => $jobcatId,
                    'joboffer_id' => $company_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            //求人都道府県関連テーブルを登録する
            $JobofferPrefecture = new JobofferPrefecture();
            $JobofferPrefecture->job_id = $company_id;
            $JobofferPrefecture->prefecuture_id = $jobPostingAll['prefectureId'];
            $JobofferPrefecture->save();

            //インフォメーションテーブルに格納し、事務局側に反映
            information::insert([
                'company_id' => $company_id,
                'information_id' => 3,
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

    //求人情報の更新処理を行う
    public function updateJobPostingData($company_id,$jobPostingAll,$filename)
    {

        //求人募集内容関連テーブルを更新する（delete→insert)
        JoboffersJobofferdetail::where('joboffer_id', $company_id)->delete();

        if(!empty($jobPostingAll['JobofferdetailCat']))
        {
            foreach ($jobPostingAll['JobofferdetailCat'] as $jobcatId) {
                JoboffersJobofferdetail::insert([
                    'jobcat_id' => $jobcatId,
                    'joboffer_id' => $company_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        //求人都道府県テーブルを更新する
        JobofferPrefecture::where('job_id', $company_id)->update(['prefecuture_id' => $jobPostingAll['prefectureId']]);

        //prefectureIdからprefectureNameを取得する
        $prefectureName = PrefecturesCat::select('catName')->where('prefecuture_id', $jobPostingAll['prefectureId'])->get();
        

        //求人情報テーブルを更新する
        $updateData = [
            'prefecuture_catch_head' => $jobPostingAll['prefecuture_catch_head'],
            'prefecuture_catch_reading' => $jobPostingAll['prefecuture_catch_reading'],
            // 'address_num' => $jobPostingAll['address_num'],
            'prefectureName' => $prefectureName[0]->catName,
            'addressDetail' => $jobPostingAll['addressDetail'],
            'working_hours' => $jobPostingAll['working_hours'],
            'monthly_income' => $jobPostingAll['monthly_income'],
            'offer1_by_tel' => $jobPostingAll['offer1_by_tel'],
            'offer1_by_form' => $jobPostingAll['offer1_by_form'],
            'offer2_by_tel' => $jobPostingAll['offer2_by_tel'],
            'offer2_by_form' => $jobPostingAll['offer2_by_form']
        ];

        //prefecuture_imageに関しては、定義されている場合すなわちアップロードされた場合はアップロードしたファイル名で更新する
        if (!empty($filename)) {
            $updateData['prefecuture_image'] = $filename;
        }

        //インフォメーションテーブルに格納し、事務局側に反映
        information::insert([
            'company_id' => $company_id,
            'information_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Joboffer::where('company_id', $company_id)->update($updateData);

    }
 
    
    public function fetchCompanyDetailSearchData($search_freeword)
    {
        // 会社情報の取得
        $jobPostings = DB::table('joboffers as jo')
            ->leftJoin('companiesdetails as cd', 'jo.company_id', '=', 'cd.company_id')
            ->leftJoin('companies as cp', 'cp.company_id', '=', 'cd.company_id')
            ->select('cp.company_id','cp.company_name', 'jo.updated_at')
            ->where('cp.company_name', 'like',"%$search_freeword%")
            ->orderBy('cp.company_id' , 'desc')
            ->paginate(10);

        return $jobPostings;
    }


}