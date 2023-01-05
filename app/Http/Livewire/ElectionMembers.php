<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ElectionMember;
use Illuminate\Database\Eloquent\Builder;


class ElectionMembers extends Component
{
    public $select = "all";
    public function render()
    {
        if ($this->select == "winner") {
            $members = ElectionMember::whereHas('votes', function (Builder $query) {
                $query->where('is_win', true);
            }, '>=', 6)->paginate();
        } else {
            $members = ElectionMember::paginate();
        }

        return view('livewire.election-member', [
            'members' => $members,
        ]);
    }
}
