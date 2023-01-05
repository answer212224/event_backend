<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BdAnimalVote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pet()
    {
        return $this->belongsTo(BdAnimalPet::class, 'bd_animal_pet_id', 'id');
    }
}
