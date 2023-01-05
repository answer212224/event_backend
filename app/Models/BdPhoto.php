<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BdPhoto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(BdPhotoMember::class, 'bd_photo_member_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getImageAttribute($value)
    {
        return env('PGW_URL') . "photos/{$value}";
    }

    public function votes()
    {
        return $this->hasMany(BdPhotoVote::class);
    }
}
