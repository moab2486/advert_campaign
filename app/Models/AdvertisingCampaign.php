<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisingCampaign extends Model
{
    use HasFactory;

    protected $casts = [
        'advert_creatives_path'
    ];

    protected $fillable = [
        'advert_name',
        'advert_date_from',
        'advert_date_to',
        'daily_advert_budget',
        'total_advert_budget',
        'advert_creatives_path'
    ];
}
