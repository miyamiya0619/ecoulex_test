<?php

namespace App\Services;

use App\Models\WaterproofdetailsCat;
use App\Models\PrefecturesCat;
use Illuminate\Support\Collection;

class ContactService
{
    public function getIndexData()
    {
        $categories = WaterproofdetailsCat::all();
        $prefectures = PrefecturesCat::all();
        return compact('categories', 'prefectures');
    }

    public function getCategoryAndPrefectureData($categoryIds, $prefectureIds): array
    {
        $categories = $this->getCategories($categoryIds);
        $groupedPrefectures = $this->getGroupedPrefectures($prefectureIds);
        
        return [$categories, $groupedPrefectures];
    }

    private function getCategories($categoryIds): Collection
    {
        return WaterproofdetailsCat::whereIn('waterproofcat_id', $categoryIds)
            ->pluck('catName', 'waterproofcat_id');
    }

    private function getGroupedPrefectures($prefectureIds): Collection
    {
        $prefectures = PrefecturesCat::whereIn('prefecuture_id', $prefectureIds)
            ->select('prefecuture_id', 'catName', 'region_id', 'regionName')
            ->get();

        return $prefectures->groupBy('region_id')->map(function ($regionPrefectures, $regionId) {
            $regionName = $regionPrefectures->first()['regionName'] ?? null;
            $prefecturesData = $regionPrefectures->map(function ($prefecture) {
                return [
                    'prefecture_id' => $prefecture['prefecuture_id'],
                    'prefecture_name' => $prefecture['catName'],
                ];
            });

            return [
                'region_id' => $regionId,
                'regionName' => $regionName,
                'prefectures' => $prefecturesData,
            ];
        })->values();
    }

}
