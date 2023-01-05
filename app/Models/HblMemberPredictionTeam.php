<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HblMemberPredictionTeam extends Model
{
    use HasFactory;

    protected $fillable = ['hbl_team_id', 'is_app'];


    public function team()
    {
        return $this->belongsTo(HblTeam::class, 'hbl_team_id');
    }

    protected $casts = [
        'is_win' => 'boolean',
    ];
}
