<?php

namespace App\Services;

use App\Models\WaterproofdetailsCat;
use App\Models\PrefecturesCat;
use Illuminate\Support\Collection;

class RecruitService
{
    public function getPrefectureData()
    {
        $prefectures = PrefecturesCat::all();
        return $prefectures;
    }

}
