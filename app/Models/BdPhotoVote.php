<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BdPhotoVote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pet()
    {
        return $this->belongsTo(BdPhoto::class, 'bd_photo_id', 'id');
    }
}
