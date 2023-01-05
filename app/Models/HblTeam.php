<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HblTeam extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function predictions()
    {
        return $this->hasMany(HblMemberPredictionTeam::class);
    }
}
