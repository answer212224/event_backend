<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NewsPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddNewsPrize extends Component
{
    use LivewireAlert;

    public $year;
    public $category = '大事件獎';
    public $award;
    public $prize;
    public $amount;

    protected $listeners = [
        'confirmed'
    ];

    public function check()
    {
        $prize = [
            'lottery_year' => $this->year,
            'category' => $this->category,
            'award' => $this->award,
            'prize' => $this->prize,
            'amount' => $this->amount
        ];
        $validator = Validator::make($prize, [
            'lottery_year' => 'required|numeric',
            'category' => 'required|string',
            'award' => 'required|string',
            'prize' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $this->alert('warning', $validator->errors()->first());
        } else {
            $this->alert('warning', '請確認填寫內容是否正確 ?', [
                'showConfirmButton' => true,
                'confirmButtonText' => 'Confirm',
                'showCancelButton' => true,
                'onConfirmed' => 'confirmed',
                'cancelButtonText' => 'Cancel',
                'onDismissed' => 'cancelled',
                'timer' => '10000',
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function confirmed(Request $request)
    {

        NewsPrize::create([
            'lottery_year' => $this->year,
            'category' => $this->category,
            'award' => $this->award,
            'prize' => $this->prize,
            'amount' => $this->amount
        ]);

        $y = now()->format('Y');
        $this->flash('success', 'Successfully submitted form', [], $request['fingerprint']['path'] . "?table[filters][year]={$this->year}");
    }

    public function render()
    {
        return view('livewire.add-news-prize');
    }
}
