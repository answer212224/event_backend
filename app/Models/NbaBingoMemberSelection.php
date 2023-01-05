<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NbaBingoMemberSelection extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function nbaBingoQuestion()
    {
        return $this->belongsTo(NbaBingoQuestion::class);
    }
}
