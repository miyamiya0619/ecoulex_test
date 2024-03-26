<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joboffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'prefecuture_catch_head',
        'prefecuture_catch_reading',
        'address_num',
        'prefecuture_image',
        'prefectureName',
        'addressDetail',
        'working_hours',
        'working_hours',
        'offer1_by_tel',
        'offer1_by_form',
        'offer2_by_tel',
        'offer2_by_form'
    ];
}
