<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MrtWinner;
use Livewire\WithPagination;

class ShowWinners extends Component
{
    use WithPagination;
    public $award = '2022-07-01,2022-07-07';

    public function render()
    {
        return view(
            'livewire.show-winners',
            [
                'mrtWinners' => MrtWinner::with('member')->where('award', 'like', $this->award . '%')->orderBy('id')->get(),
            ]
        );
    }
}
