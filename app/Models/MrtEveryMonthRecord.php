<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrtEveryMonthRecord extends Model
{
    use HasFactory;

    protected $connection = 'lab';

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(MrtMember::class, 'outer_code', 'outer_code');
    }
}
