<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BdAnimalPet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(BdAnimalMember::class, 'bd_animal_member_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getImageAttribute($value)
    {
        return env('PGW_URL') . "pets/{$value}";
    }

    public function votes()
    {
        return $this->hasMany(BdAnimalVote::class);
    }
}
