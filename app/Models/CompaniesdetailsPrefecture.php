<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesdetailsPrefecture extends Model
{
    use HasFactory;
    protected $fillable =  [
        'company_id',
        'prefecuture_id'
    ];
}
