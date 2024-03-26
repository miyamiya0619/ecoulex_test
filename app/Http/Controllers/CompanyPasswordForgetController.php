<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CompanyPasswordForgetController extends Controller
{

    public function index()
    {
        return view('kanri.registration.forgot_password');
    }
}
