<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NbaBingoQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function selections()
    {
        return $this->hasMany(NbaBingoMemberSelection::class);
    }
}
