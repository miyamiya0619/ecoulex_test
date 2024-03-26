<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waterproof extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'waterproofing_job_catch',
        'waterproofing_job_description',
        'waterproofing_job_image'
    ];
}
