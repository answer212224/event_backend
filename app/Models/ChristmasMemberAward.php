<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChristmasMemberAward extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getAwardNameAttribute()
    {
        if ($this->award_id == 1) return '威秀電影票';
        if ($this->award_id == 2) return '西堤餐卷';
        if ($this->award_id == 3) return '7-11商品卡';
        if ($this->award_id == 4) return '聖誕驚喜包';
    }
}
