<?php

namespace App\Exports;

use App\Models\Keyword;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeywordExport implements FromCollection
{
    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {

        return Keyword::whereIn('id', $this->users)->get();
    }
}
