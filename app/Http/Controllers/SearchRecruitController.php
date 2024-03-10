<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecruitService;

class SearchRecruitController extends Controller
{

    private $RecruitService;
    
    public function __construct(RecruitService $recruitService)
    {
        $this->RecruitService = $recruitService;
    }

    //初期表示
    public function index()
    {
        return view('recruit.top');
    }


}

