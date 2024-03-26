<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobofferPrefecture extends Model
{
    use HasFactory;
    protected $fillable =  [
        'job_id',
        'prefecuture_id'
    ];
}
